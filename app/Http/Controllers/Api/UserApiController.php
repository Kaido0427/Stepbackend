<?php

namespace App\Http\Controllers\Api;




use App\AdminSetting;
use App\AppUsers;
use App\Facilities;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Notifications\SendPassword;
use App\NotificationTemplate;
use App\ParkingBooking;
use App\ParkingOwner;
use App\ParkingOwnerSetting;
use App\ParkingSpace;
use App\Review;
use App\SpaceSlot;
use App\SpaceZone;
use App\VehicleType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Controllers\Api\currencyConvertController;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail;

class UserApiController extends Controller
{

    public function displayVehicleType()
    {
        //
        return response()->json(['msg' => null, 'data' => VehicleType::where('status', 1)->get(), 'success' => true], 200);
    }


    public function storeParkingBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_id' => 'required|exists:parking_owner,id',
            'space_id' => 'required|exists:parking_space,id',
            'slot_id' => 'required|exists:space_slot,id',
            'vehicle_id' => 'required|exists:user_vehicle,id',
            'arriving_time' => 'required|date',
            'leaving_time' => 'required|after:arriving_time',
            'total_amount' => 'required|numeric|min:1',
            'payment_type' => 'required',
            'currency' => 'required|in:EUR,USD',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $reqData = $validator->validated();
        $currency = $reqData['currency'];
        $reqData['arriving_time'] = Carbon::parse($reqData['arriving_time'])->format('Y-m-d H:i:s');
        $reqData['leaving_time'] = Carbon::parse($reqData['leaving_time'])->format('Y-m-d H:i:s');
        $reqData['user_id'] = Auth::user()->id;
        $reqData['order_no'] = uniqid();
        $reqData['status'] = 0; // Payment status set to 0 initially

        $slot_state = SpaceSlot::find($reqData['slot_id']);
        if (!$slot_state || $slot_state->is_active == 0) {
            return response()->json(['error' => 'This slot is not available'], 400);
        }

        try {
            if ($reqData['payment_type'] == 'paypal') {
                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $provider->getAccessToken();
                // Create transaction

                if ($currency == "USD") {
                    $currencyConverter = new currencyConvertController();
                    $taux = $currencyConverter->getConversionRate($request);

                    if ($taux->getStatusCode() !== 200) {
                        // Traitement des erreurs
                        return $taux; // Retourner directement la réponse d'erreur
                    }

                    $conversionRateData = json_decode($taux->getContent(), true);
                    $taux = $conversionRateData['conversionRate'];
                    if (!isset($reqData['total_amount'])) {
                        throw new \Exception("Le montant total ('total_amount') est manquant dans les données de réservation.");
                    }

                    $montant = $reqData['total_amount'];
                    $montant_USD = round($taux * $montant, 2); // Arrondi à 2 décimales
                    $response = $provider->createOrder([
                        "intent" => "CAPTURE",
                        "application_context" => [
                            "return_url" => "https://seamoi.com/successTrans",
                            "cancel_url" => "https://seamoi.com/cancelTrans"
                        ],
                        "purchase_units" => [
                            0 => [
                                "amount" => [
                                    "currency_code" => $currency,
                                    "value" => $montant_USD
                                ]
                            ]
                        ]
                    ]);
                } else {
                    $response = $provider->createOrder([
                        "intent" => "CAPTURE",
                        "application_context" => [
                            "return_url" => "https://seamoi.com/successTrans",
                            "cancel_url" => "https://seamoi.com/cancelTrans"
                        ],
                        "purchase_units" => [
                            0 => [
                                "amount" => [
                                    "currency_code" => $currency,
                                    "value" => $reqData['total_amount']
                                ]
                            ]
                        ]
                    ]);
                }

                // Log the response for debugging
                Log::info('PayPal createOrder response:', $response);
                if (isset($response['id']) && $response['id'] != null) {
                    // Return approve URL
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            // Sauvegarde des données de réservation dans la base de données
                            $booking = ParkingBooking::create($reqData);
                            // Récupération du token de paiement depuis l'URL de redirection PayPal
                            $paymentUrl = $links['href'];
                            $paymentUrlParts = parse_url($paymentUrl);
                            parse_str($paymentUrlParts['query'], $query);
                            $paymentToken = $query['token'];
                            // Mettre à jour le champ payment_token dans la table parking_bookings
                            $booking->payment_token = $paymentToken;

                            $booking->lien_de_transaction = $paymentUrl;
                            // Sauvegarder les modifications dans la base de données
                            $booking->save();
                            // Mettre à jour le statut de paiement
                            $bookingId = $booking->id;

                            return response()->json([
                                'Devise' => $currency,
                                'reservation_data' => $booking,
                                'message' => 'Reservation created successfully'
                            ]);
                        }
                    }

                    return response()->json(['error' => 'Un probleme avec la transaction.'], 500);
                } else {
                    return response()->json(['error' => $response['message'] ?? 'Something went wrong.'], 500);
                }
            } else {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                // Create a Stripe customer
                $customer = \Stripe\Customer::create([
                    'email' => Auth::user()->email,
                ]);

                $amount = $reqData['total_amount'];

                if ($currency == "USD") {
                    $currencyConverter = new currencyConvertController();
                    $taux = $currencyConverter->getConversionRate($request);

                    if ($taux->getStatusCode() !== 200) {
                        // Traitement des erreurs
                        return $taux; // Retourner directement la réponse d'erreur
                    }

                    $conversionRateData = json_decode($taux->getContent(), true);
                    $taux = $conversionRateData['conversionRate'];

                    $amount_USD = round($taux * $amount, 2); // Arrondi à 2 décimales
                    $amount = $amount_USD;
                }

                // Create a Stripe payment intent
                $paymentIntent = \Stripe\PaymentIntent::create([
                    'amount' => (int) ($amount * 100), // Stripe expects the amount in the smallest currency unit (e.g., cents for USD)
                    'currency' => $currency,
                    'customer' => $customer->id,
                    'description' => 'Reservation pour stationnement ',
                    'payment_method' => 'pm_card_mastercard',
                    'metadata' => ['ordre_no' => $reqData['order_no']],

                ]);


                if (isset($paymentIntent['id']) && $paymentIntent['id'] != null) {
                    // Save booking data in the database
                    $booking = ParkingBooking::create($reqData);

                    // Update the payment_token field in the parking_bookings table
                    $booking->payment_token = $paymentIntent['id'];
                    $booking->lien_de_transaction = $paymentIntent['client_secret'];
                    $booking->save();


                    // Update the payment status
                    $bookingId = $booking->id;

                    return response()->json([
                        'currency' => $currency,
                        'reservation_data' => $booking,
                        'message' => 'Réservation créée avec succès!'

                    ]);
                } else {
                    return response()->json(['error' => $paymentIntent['message'] ?? 'Something went wrong.'], 500);
                }
            }

            $bookingTime = Carbon::now();
            $delai = $bookingTime->copy()->addHours(1);

            if (Carbon::now()->greaterThan($delai)) {
                // Mettre à jour le statut de la réservation à 4
                DB::table('parking_booking')
                    ->where('order_no', $reqData['order_no']) // Utilisation de l'ID de la réservation
                    ->update(['status' => 4]);

                return response()->json([
                    'message' => 'Votre reservation s\'annule si vous ne payez pas apres 1h de temps ecoulé;veillez reservé dans le temps imparti.Merci !'
                ], 200);
            }

            $spaceData = ParkingSpace::find($reqData['space_id']);
            // Notification logic and other operations
            // ...

            $header = "Reminder from " . $spaceData->title;
            $text = 'Your parking with ' . $spaceData->title . ' is scheduled at :- ' . $reqData['arriving_time'];

            $data['header'] = $header;
            $data['text'] = $text;

            return response()->json([
                'reservation_data' => $reqData,
                'message' => 'Reservation created successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function bookingCancel($id)
    {
        $data = ParkingBooking::find($id);
        $data->status = 4;
        $data->save();
        $data = ParkingBooking::with(['user', 'space:id,title,address'])->where([['id', $id]])->get()->first();
        $appuser = AppUsers::find($data->user_id)->name;
        $owner = ParkingOwner::find($data->owner_id)->device_token;
        try {
            $notification_template1 = NotificationTemplate::where('title', 'cancel appointment')->first();
            $msg_content = $notification_template1->msg_content;
            $detail1['spaceName'] = $data['space']['title'];
            $detail1['user'] = $appuser;
            $content = ["{spaceName}", "{user}"];
            $message = str_replace($content, $detail1, $msg_content);
            $header =  'Sorry for inconvenience';
            $app = AdminSetting::get(['id', 'notification'])->first();
            $userId = $data['user']['device_token'];
            $app_id = AdminSetting::first()->owner_app_id;
            if ($owner && $app->notification == 1) {
                $content1 = array(
                    "en" => $message
                );
                $fields1 = array(
                    'app_id' => $app_id,
                    'include_player_ids' => array($owner),
                    'data' => null,
                    'contents' => $content1
                );
                $fields1 = json_encode($fields1);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                $response = curl_exec($ch);
                curl_close($ch);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return response()->json(['msg' => 'Booking Is Cancel', 'data' => null, 'success' => true], 200);
    }
    public function storeReview(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['msg' => 'Unauthorized', 'success' => false], 401);
            }

            $reqData = $request->all();
            $reqData['user_id'] = $user->id;
            Review::create($reqData);

            return response()->json(['msg' => 'Review stored successfully', 'success' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error occurred', 'success' => false], 500);
        }
    }


    public function showParkingBooking($id)
    {
        $data = ParkingBooking::with(['space:id,title,address,lat,lng'])->where('id', $id)->first();
        return response()->json(['msg' => 'Thanks', 'data' => $data, 'success' => true], 200);
    }
    public function displayParkingBooking()
    {
        $data = array();

        // Récupération des réservations en attente de paiement, d'acceptation ou lorsque le vélo est déjà stationné
        $dataCurrant = ParkingBooking::with(['space:id,title,address'])
            ->where('user_id', Auth::user()->id)
            ->whereIn('status', [0, 1, 2])
            ->get();

        // Récupération des réservations achevées
        $dataCompleted = ParkingBooking::with(['space:id,title,address'])
            ->where('user_id', Auth::user()->id)
            ->where('status', 3)
            ->get();

        // Récupération des réservations annulées
        $dataCancelled = ParkingBooking::with(['space:id,title,address'])
            ->where('user_id', Auth::user()->id)
            ->where('status', 4)
            ->get();

        $data['En cours'] = $dataCurrant;
        $data['complete'] = $dataCompleted;
        $data['cancelled'] = $dataCancelled;

        return response()->json(['msg' => 'Merci', 'data' => $data, 'success' => true], 200);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([

            'name' => 'bail|required',
            'phone_no' => 'bail|required',
        ]);
        auth()->user()->update($request->all());
        return response()->json(['msg' => 'Profile Updated', 'data' => null, 'success' => true], 200);
    }
    public function profilePictureUpdate(Request $request)
    {
        // Vérifiez si une image a été soumise
        if ($request->hasFile('image')) {
            // Obtenez l'utilisateur connecté
            $user = auth()->user();

            // Vérifiez si l'utilisateur existe
            if ($user) {
                // Obtenez le fichier image téléchargé
                $image = $request->file('image');

                // Générez un nom de fichier unique
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                // Déplacez le fichier vers le dossier personnalisé
                $image->move('upload/', $imageName);

                // Mettez à jour l'image de l'utilisateur avec le nom de fichier uniquement
                $user->image = $imageName;
                $user->save();

                return response()->json(['msg' => 'Image de profil mise à jour', 'data' => null, 'success' => true], 200);
            } else {
                return response()->json(['msg' => 'Utilisateur non trouvé', 'data' => null, 'success' => false], 404);
            }
        } else {
            return response()->json(['msg' => 'Aucune image soumise', 'data' => null, 'success' => false], 400);
        }
    }


    public function deleteAccount()
    {
        $user = auth()->user();
        $booking = ParkingBooking::where('user_id', $user->id)->where('payment_status', 0)->first();
        if (isset($booking) && $user->email == 'demouser@saasmonks.in') {
            return response()->json(['success' => false, 'message' => 'Account Cant\'t Delete']);
        } else {
            $timezone = AdminSetting::first()->timezone;
            $user->name = 'Deleted User';
            $user->email = ' deleteduser_' . Carbon::now($timezone)->format('Y_m_d_H_i_s') . '@saasmonks.in';
            $user->phone_no = '0000000000';
            $user->verified = 0;
            $user->status = 0;
            $user->save();
            Auth::user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        return response()->json(['success' => true, 'message' => 'Account Delete Successfully!']);
    }
    public function settingShow($id)
    {
        $settings = ParkingOwnerSetting::where('owner_id', $id)->first();
        return response()->json(['msg' => 'Setting Updated', 'data' => $settings, 'success' => true], 200);
    }
    public function allSetting()
    {
        $data = AdminSetting::first(['currency', 'currency_symbol', 'app_id', 'stripe_status', 'stripe_secret', 'stripe_public', 'paypal_status', 'paypal_production', 'paypal_client_id', 'paypal_secret_key',]);

        if (!$data) {
            return response()->json(['msg' => 'Settings not found', 'success' => false], 404);
        }

        return response()->json(['msg' => null, 'data' => $data, 'success' => true], 200);
    }

    public function forgotPassword(Request $request)
    {
        $password = rand(100000, 999999);
        $setting = AdminSetting::first();
        $gard =  ParkingOwner::where('email', $request->email)->first();
        if ($gard) {
            $gard->password = $password;
            $gard->save();
            $config = array(
                'driver'     => $setting->mail_driver,
                'host'       => $setting->mail_host,
                'port'       => $setting->mail_port,
                'from'       => array('address' => $setting->mail_from_address, 'name' => $setting->mail_from_name),
                'encryption' => $setting->mail_encryption,
                'username'   => $setting->mail_username,
                'password'   => $setting->mail_password
            );
            Config::set('mail', $config);
            $gard->notify(new SendPassword($password));
            return response()->json(['msg' => 'Password send to your email address', 'data' => null, 'success' => true], 200);
        }
        return response()->json(['msg' => 'No User Found', 'data' => null, 'success' => false], 200);
    }

    public function storeUser(Request $request)
    {
        try {
            $request->merge(['OTP' => null]); // Ajout du champ OTP avec valeur null dans la requête

            $request->validate([
                'email' => 'bail|required|email|unique:app_users,email',
                'name' => 'bail|required',
                'password' => 'bail|required|confirmed|min:6',
                'OTP' => 'nullable|integer|digits:6', // Validation du champ OTP
            ]);

            $reqData = $request->all();

            $app = AdminSetting::get(['id', 'verification'])->first();
            $flow = $app->verification == 1 ? 'verification' : 'home';

            if ($app->verification != 1) {
                $reqData['verified'] = 1;
            }

            $data = AppUsers::create($reqData);

            $otp = rand(100000, 999999); // Génération d'un code OTP à 6 chiffres aléatoire
            // Mise à jour de l'OTP dans la base de données
            $data->OTP = $otp;
            $data->save();

            $this->sendEmailVerification($data, $otp);


            $token = $data->createToken('ParingAppUser')->accessToken;
            $data['token'] = $token;

            return response()->json([
                'nextStep' => $flow,
                'msg' => 'Registered Successfully',
                'data' => $data,
                'success' => true
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'msg' => 'Validation Error',
                'errors' => $e->errors(),
                'success' => false
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'An error occurred',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }


    public function reqForOTP(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        // Recherche de l'utilisateur par email ou numéro de téléphone
        $userData = AppUsers::where('email', $request->email)->first();
        $requestOtp = (int) $request->otp;
        if ($userData) {
            if ($userData->email_verified === 1) {
                return response()->json(['msg' => 'You are already verified', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
            } else {
                if ($userData->OTP === $requestOtp) {
                    $userData->email_verified = 1;
                    $userData->save();

                    // Génération et envoi du token d'authentification
                    $token = $userData->createToken('ParingAppUser')->accessToken;
                    $userData['token'] = $token;

                    return response()->json(['msg' => 'Thanks For being With us', 'data' => $userData, 'success' => true], 200);
                } else {
                    return response()->json(['msg' => 'OTP is incorrect', 'data' => null, 'success' => false], 200);
                }
            }
        } else {
            return response()->json(['msg' => 'Email or phone number not found', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ]);
    
        $user = AppUsers::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->email_verified != 1) {
                return response()->json(['msg' => 'Veuillez confirmer votre inscription avant de vous connecter.', 'data' => null, 'success' => false], 200);
            }
    
            $token = $user->createToken('stepOwner')->accessToken;
            $user['device_token'] = $request->device_token;
            $user->save();
            $user['token'] = $token;
    
            return response()->json(['msg' => 'Connexion réussie', 'data' => $user, 'success' => true], 200);
        } else {
            return response()->json(['message' => 'Votre adresse e-mail et votre mot de passe ne correspondent pas à nos enregistrements'], 401);
        }
    }
    

    public function verifyMe(Request $request)
    {
        $request->validate([

            'email' => 'bail|required',
            'phone_no' => 'bail|required',

        ]);
        $userData = AppUsers::Where([['email', $request->email], ['phone_no', $request->phone_no]])->first();
        if ($userData && $userData['verified'] === 1) {
            return response()->json(['msg' => 'You already verify ', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        } else if ($userData && $userData['verified'] !== 1) {

            if ($userData['OTP'] === $request->OTP) {
                $userData->OTP = '';
                $userData->verified = 1;
                $userData->save();
                $token = $userData->createToken('ParingAppUser')->accessToken;
                $userData['token'] = $token;
                return response()->json(['msg' => 'Thanks For being With us', 'data' => $userData, 'success' => true], 200);
            }
            return response()->json(['msg' => 'OTP is Wrong', 'data' => null, 'success' => false], 200);
        } else {
            return response()->json(['msg' => 'Email and number are attached with different account', 'data' => null, 'success' => false, 'redirect' => 'login'], 200);
        }
    }
    public function getNearByParking(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $apo = ParkingOwner::where([['status', 1], ['subscription_status', 1]])->get(['id']);
        $array = $apo->pluck('id')->toArray();

        // Vérifie si le tableau $array est vide avant de continuer
        if (empty($array)) {
            return response()->json(['msg' => 'No parking spaces available', 'success' => false], 404);
        }

        $data = ParkingSpace::withCount(['reviews'])
            ->where('verified', 1)
            ->where('status', 1)
            ->whereIn('owner_id', $array)
            ->get();

        // Vérifie si $data est vide avant d'effectuer les opérations suivantes
        if ($data->isEmpty()) {
            return response()->json(['msg' => 'No parking spaces available', 'success' => false], 404);
        }

        $data->each(function ($ps) use ($request) {
            $ps->distance = (new AppHelper)->calculateDistance($ps->lat, $ps->lng, $request->lat, $request->lng, 'K');
            $ps->append('avg_rating');
        });

        $sortedData = $data->sortBy('distance')->values();

        return response()->json(['msg' => 'Success', 'data' => $sortedData, 'success' => true], 200);
    }



    public function getNearByParkingSingle(Request $request, $id)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        try {
            // Recherche de l'espace de stationnement par son identifiant ($id)
            $ps = ParkingSpace::with(['reviews.user', 'images'])
                ->findOrFail($id)
                ->setAppends(['facilitiesData', 'avg_rating']);
            if ($ps->reviews) {
                $ps->reviews_count = $ps->reviews->count();
            } else {
                // S'il n'y a pas de critiques, définissez reviews_count à null
                $ps->reviews_count = null;
            }

            // Calculer la distance
            $distance = (new AppHelper)->calculateDistance($ps->lat, $ps->lng, $request->lat, $request->lng, 'K');

            // Retourner les données
            return response()->json([
                'msg' => null,
                'data' => [
                    'parking_space' => $ps,
                    'distance' => $distance,
                ],
                'success' => true
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['msg' => 'Parking Space not found', 'data' => null, 'success' => false], 404);
        }
    }


    public function getParkingZone(Request $request, $id)
    {
        $start = Carbon::parse($request->startTime)->format('Y-m-d H:i:s');
        $end = Carbon::parse($request->endTime)->format('Y-m-d H:i:s');

        $ps = SpaceZone::with(['slots' => function ($query) {
            $query->where('is_active', 1);
        }])->where('space_id', $id)->get();

        foreach ($ps as $value) {
            foreach ($value['slots'] as &$slot) {
                $booking = ParkingBooking::where('slot_id', $slot['id'])->whereIn('status', [0, 1])->get();
                if (count($booking) > 0) {
                    foreach ($booking as &$b) {
                        $a_date = Carbon::parse($b->arriving_time)->format('Y-m-d H:i:s');
                        $l_date = Carbon::parse($b->leaving_time)->format('Y-m-d H:i:s');
                        $st = Carbon::parse($start);
                        $et = Carbon::parse($end);
                        if ($st->between($a_date, $l_date)) {
                            $slot['available'] = false;
                        } else {
                            $slot['available'] = true;
                        }
                    }
                } else {
                    $slot['available'] = true;
                }
            }
        }
        return response()->json(['msg' => null, 'data' => $ps, 'success' => true], 200);
    }


    public function displayFacilities()
    {
        return response()->json(['msg' => null, 'data' => Facilities::all(), 'success' => true], 200);
    }
    public function ppApi()
    {
        $pp = AdminSetting::get()->first();
        return response()->json(['msg' => null, 'data' => $pp, 'success' => true], 200);
    }




    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->input('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $booking = ParkingBooking::where('payment_token', $request->input('token'))->first();
            if ($booking) {
                $booking->status = 1;
                $booking->save();
                return response()->json(['message' => 'Transaction  effectué avec succes vous pouvez fermer la page :)'], 200);
            } else {
                return response()->json(['error' => 'Reservation not found.'], 404);
            }
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return response()->json(['erreur' => 'Transaction annulé,Vous pouvez fermer cette page.'], 404);
    }

    public function confirmStripay($id)
    {
        $data = ParkingBooking::find($id);
        $data->status = 1;
        $data->save();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe->invoices->create([
            'customer' => $data->status = 1,
            'collection_method' => 'send_invoice',
            'days_until_due' => 30,
        ]);

        $stripe->invoices->sendInvoice($data->payment_token, ['collection_method' => 'send_invoice']);


        $data = ParkingBooking::with(['user', 'vehicle:id,model,vehicle_no', 'space:id,title,address'])->where([['id', $id]])->get()->first();

        return response()->json(['msg' => 'Votre payement par stripe est confirmé avec succes', 'data' => $data, 'success' => true], 200);
    }

    public function sendEmailVerification($user, $otp)
    {
        $subject = 'Email Verification';
        $app_name = 'STEP'; // Remplacez par le nom de votre application

        Mail::to($user->email)->send(new EmailVerificationMail($subject, $app_name, $user->email, $otp));
    }


    public function mailer()
    {
        return view('emailverification');
    }
}

<?php

namespace App\Http\Controllers\Website;

use App\AdminSetting;
use App\AppUsers;
use App\Facilities;
use App\FAQ;
use App\Http\Controllers\AppHelper;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Mail\EmailVerificationMail;
use App\Notifications\SendPassword;
use App\NotificationTemplate;
use App\ParkingBooking;
use App\ParkingImage;
use App\ParkingOwner;
use App\ParkingSpace;
use App\Review;
use App\SpaceSlot;
use App\SpaceZone;
use App\UserVehicle;
use Exception;
use Carbon\Carbon;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;
use Symfony\Component\Mailer\Transport\Dsn;

class WebsiteController extends Controller
{
    public function dashboard()
    {
        $services = Facilities::all();
        $duplicateIds = ParkingBooking::select('slot_id')->groupBy('slot_id')->havingRaw('COUNT(*) > 1')->take(3)->pluck('slot_id')->toArray();
        $spaceslots = SpaceSlot::whereIn('id', $duplicateIds)->get();
        foreach ($spaceslots as $key => $value) {
            $value->address = ParkingSpace::find($value->space_id)->address;
            $value->image = ParkingImage::find($value->space_id);
            $value->rate = Review::find($value->space_id);
        }
        return view('website.home', compact('services', 'duplicateIds', 'spaceslots'));
    }
    public function logOut()
    {
        if (Auth::guard('appuser')->check()) {
            Auth::guard('appuser')->logout();
            return redirect('/');
        }
    }
    public function userLogin(Request $request)
    {
        $rules = [
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:6',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        if (Auth::guard('appuser')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('appuser')->user();
            if ($user->email_verified == 1) {
                return response()->json(['success' => true, 'message' => 'Login successfully', 'redirect_location' => url("/")]);
            } else {
                Auth::guard('appuser')->logout();
                $email = $user->email;
                return response()->json(['success' => false, 'message' => 'Please verify your email', 'data' => $email, 'email' => $request->email]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid credentials']);
        }
    }

    public function userRegister(Request $request)
    {
        $rules = [
            'email' => 'bail|required|email|unique:app_users,email',
            'name' => 'bail|required|max:20',
            'password' => 'required|string|min:6',
            'confirmpassword' => 'required|min:6|same:password',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }

        $reqData = $request->all();
        $settings = AdminSetting::first();

        $email_otp = rand(100000, 999999);
        $reqData['email_otp'] = $email_otp;
        $user = AppUsers::create($reqData);

        if ($settings->email_verification == 1) {
            $reqData['email_verified'] = 0;
            try {
                $setting = AdminSetting::first();
                $subject = 'Email Verification';
                $useremail = $reqData['email'];
                $otp = $reqData['email_otp'];

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
                Mail::to($request->email)->send(new EmailVerificationMail($subject, $setting->name, $useremail, $otp));
                return response()->json(['success' => true, 'message' => 'Email verification OTP has been sent to your registered email, Please login verify with that code
                ']);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'data' => $e, "redirect_location" => url("/")]);
            }
        } else {
            $reqData['email_verified'] = 1;
            $user->update(['email_verified' => 1]);
        }
        return response()->json(['success' => true, 'message' => 'Registered successfully']);
    }

    public function resendMail(Request $request)
    {
        $email = $request->email;
        $email_otp = rand(100000, 999999);
        if ($email) {
            try {
                $user = AppUsers::where('email', $email)->first();

                if ($user) {
                    $setting = AdminSetting::first();
                    $subject = 'Email Verification';
                    $useremail = $user->email;

                    // Update email_otp in the user record
                    $user->email_otp = $email_otp;
                    $user->save();

                    $otp = $email_otp;

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
                    Mail::to($useremail)->send(new EmailVerificationMail($subject, $setting->name, $useremail, $otp));

                    return response()->json(['success' => true, 'message' => 'Email verification OTP has been sent to your registered email.']);
                } else {
                    return response()->json(['success' => false, 'message' => 'User not found']);
                }
            } catch (Exception $e) {
                return response()->json(['success' => false, 'data' => $e, 'redirect_location' => url("/")]);
            }
        }
    }


    public function userVerify(Request $request)
    {
        $rules = [
            'otp' => 'bail|required|min:6',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $userData = AppUsers::where('email_otp', $request->otp)->first();

        if ($userData && $userData['email_otp'] == $request->otp) {
            Auth::guard('appuser')->login($userData);
            $userData->email_verified = 1;
            $userData->save();
            return response()->json(['success' => true, 'data' => $userData, 'redirect_location' => url("/"), 'message' => 'Email verified successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'OTP is invalid']);
        }
    }


    public function userProfile()
    {
        return view('website.profile');
    }

    public function userChangePassword(Request $request)
    {
        $rules = [
            'currentpassword' => 'required',
            'password' => 'required|string|min:6',
            'confirmpassword' => 'required|min:6|same:password',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        if (Hash::check($request->currentpassword, Auth::guard('appuser')->user()->password)) {
            $passwords = $request->password;
            AppUsers::findOrFail(Auth::guard('appuser')->user()->id)->update(['password' => $passwords]);
            return response()->json(['success' => true, 'message' => 'Change password successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Current password does not match']);
        }
    }

    public function updateUserProfile(Request $request)
    {
        $rules = [
            'name' => 'bail|required',
            'phone' => 'bail|required|min:8',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $data = Auth::guard('appuser')->user();
        $data->name = $request->name;
        $data->phone_no = $request->phone;
        $data->update();
        return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
    }

    public function updateUserProfileImage(Request $request)
    {
        $data = Auth::guard('appuser')->user();
        $img = $request->image;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img_code = base64_decode($img);
        $Iname = uniqid();
        $file = public_path('upload/') . $Iname . ".png";
        $success = file_put_contents($file, $img_code);
        $image_name = $Iname . ".png";
        $data->image = $image_name;
        $data->update();
        return response()->json(['data' => $data]);
    }

    public function getSettings($view, $data)
    {
        $settings = AdminSetting::first();
        return view($view, array_merge(compact('settings'), $data));
    }
    public function getAboutUs()
    {
        return $this->getSettings('website.aboutus', []);
    }
    public function getPrivacyPolicy()
    {
        return $this->getSettings('website.privacypolicy', []);
    }
    public function getTermsCondition()
    {
        return $this->getSettings('website.tc', []);
    }

    public function getContactUs()
    {
        $contactus = AdminSetting::first(['address', 'email', 'phone', 'facebook_url', 'linkdin_url', 'instagram_url', 'twitter_url']);
        return view('website.contactus', compact('contactus'));
    }

    public function contactusMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $data = $request->all();
        try {
            $setting = AdminSetting::first();
            $subject = 'Contact Us';
            $message = $data['message'];
            $useremail = $data['email'];

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
            Mail::to($setting->queriemail)->send(new ContactUsMail($message, $subject, $setting->name, $useremail));
            return redirect('/contact_us')->with('success', 'Mail send successfully');
        } catch (Exception $e) {
            return response()->json(['success' => false, 'data' => $e]);
        }
    }
    public function getParkingBooking()
    {
        $dataCurrant = ParkingBooking::with(['space:id,title,address'])->where([['user_id', Auth::guard('appuser')->user()->id]])->whereIn('status', [0, 1])->get();
        $dataOld = ParkingBooking::with(['space:id,title,address'])->where([['user_id', Auth::guard('appuser')->user()->id]])->whereIn('status', [2, 3])->get();
        $settings = AdminSetting::first('currency');
        return view('website.displaybookings', compact('dataCurrant', 'dataOld', 'settings'));
    }
    public function getParkingMapList()
    {
        $parkingspace = ParkingSpace::where('status', 1)->get();
        foreach ($parkingspace as $key => $value) {
            $value->rating = Review::where('space_id', $value->id)->get()->avg('star');
        }
        $adminsetting = AdminSetting::first(['currency_symbol', 'map_key']);
        return view('website.map-list', compact('parkingspace', 'adminsetting'));
    }

    public function searchQuery(Request $request)
    {
        $request->validate([
            'search' => 'required|regex:/^[A-Za-z\s]+$/'
        ]);
        $parkingspace = ParkingSpace::where([['title', 'LIKE', "%$request->search%"], ['status', 1]])->get();
        $adminsetting = AdminSetting::first(['currency_symbol', 'map_key']);
        return view('website.map-list', compact('parkingspace', 'adminsetting'));
    }

    public function getParkingSpaceDetails($id)
    {
        $parkingdetails = ParkingSpace::where('id', $id)->get();
        $rating = Review::where('space_id', $id)->avg('star');
        $parkingimage = ParkingImage::where('space_id', $id)->get();
        $count_parkingimage = count($parkingimage);
        $reviews = Review::with('User')->where('space_id', $id)->get();
        $settings = AdminSetting::first('currency_symbol');
        $total_count_review = count($reviews);
        $all_reviews  = (new AppHelper)->All_Reviews();

        $vehicles = UserVehicle::where('user_id', Auth::guard('appuser')->user()->id)->get();
        foreach ($parkingdetails as $p) {
            if (count($p->facilities) > 0) {
                $facilities = Facilities::whereIn('id', $p->facilities)->get();
            } else {
                $facilities = NULL;
            }
        }
        return view('website.parkingdetails', compact('parkingdetails', 'parkingimage', 'reviews', 'total_count_review', 'count_parkingimage', 'facilities', 'rating', 'settings', 'vehicles', 'all_reviews'));
    }


    public function getParkingSlots(Request $request)
    {

        $id = SpaceSlot::pluck('id');

        $parkingspacedata = Session::get('parkingspace');
        $start =  Carbon::parse($parkingspacedata['arriving_time'])->format('Y-m-d H:i:s');

        $end =  Carbon::parse($parkingspacedata['leaving_time'])->format('Y-m-d H:i:s');

        $ps = SpaceZone::with(['slots'])->whereIn('space_id', $id)->get();
        $bookedslot = [];
        foreach ($ps as  $value) {
            foreach ($value['slots'] as $slot) {
                $booking = ParkingBooking::where('slot_id', $slot['id'])->whereIn('status', [0, 1])->get();

                if (count($booking) > 0) {
                    foreach ($booking as &$b) {
                        
                            $a_date = carbon::parse($b->arriving_time)->format('Y-m-d H:i:s');
                            $l_date = carbon::parse($b->leaving_time)->format('Y-m-d H:i:s');

                            $st = carbon::parse($start);

                            $et = Carbon::parse($end);

                            if ($st->between($a_date, $l_date)) {
                                $bookedslot[] = $slot->id;
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

        $spacezones = SpaceZone::where('status', 1)->get();
        $spaceslots = SpaceSlot::all();
        
        
        foreach ($spaceslots as $key => $value) {
           foreach ($bookedslot as $key => $value1) {
            
            if ($value1 == $value->id) {
                $value['available'] = true;
            }else{
                $value['available'] = false;
            }
           }
        }
        foreach ($spaceslots as $key => $value) {
            $parkingSpace = ParkingSpace::find($value->space_id);
            if ($parkingSpace) {
                $value->price_par_hour = $parkingSpace->price_par_hour;
            } else {
                $value->price_par_hour = null;
            }
        }


        $bookslots = ParkingBooking::whereIn('slot_id', $id)->pluck('slot_id', 'arriving_time', 'leaving_time')->all();
        $adminsetting = AdminSetting::first(['timezone']);

        $now = Carbon::now($adminsetting->timezone)->format('Y-m-d H:i:s');
        $booking = ParkingBooking::whereIn('slot_id', $bookslots)
            ->whereIn('status', [0, 1])->where('arriving_time', '<=', $now)
            ->where('leaving_time', '>=', $now)
            ->get();



        return view('website.parkingslots', compact('spacezones', 'spaceslots', 'id', 'bookslots', 'booking', 'adminsetting', 'ps', 'slot'));
    }
    public function getCheckout()
    {
        $adminsetting = AdminSetting::first(['paypal_status', 'razorpay_status', 'stripe_status', 'flutterwave_status', 'stripe_public', 'razorpay_key', 'flutterwave_key', 'currency', 'paypal_sandbox']);
        $vehicles = UserVehicle::where('user_id', Auth::guard('appuser')->user()->id)->get();
        $parkingspace = session('parkingspace');
        $arrivingtime = Carbon::parse($parkingspace['arriving_time']);
        $leavingtime = Carbon::parse($parkingspace['leaving_time']);
        $duration = $leavingtime->diff($arrivingtime);
        $dayDifference = $duration->d;
        $hourDifference = $duration->h;
        $minuteDifference = $duration->i;
        $secondDifference = $duration->s;

        $hourdifference = $leavingtime->diffInHours($arrivingtime);
        return view('website.checkout', compact('adminsetting', 'vehicles', 'hourdifference', 'dayDifference', 'hourDifference', 'minuteDifference', 'secondDifference'));
    }

    public function getFaqs()
    {
        $faq = FAQ::all();
        return view('website.faq', compact('faq'));
    }

    public function userForgotPassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $password = rand(100000, 999999);
        $setting = AdminSetting::first();
        $gard =  AppUsers::where('email', $request->email)->first();
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
            return response()->json(['success' => false, 'message' => 'Password send to your email address', 'redirect_location' => url("/")]);
        }
        return response()->json(['success' => false, 'message' => 'There is no user account with this email address']);
    }

    public function deleteAccount(Request $request)
    {
        $rules = [
            'accountPassword' => 'bail|required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        }
        $user = Auth::guard('appuser')->user();


        if (Hash::check($request->accountPassword, $user->password)) {
            $booking = ParkingBooking::where('user_id', $user->id)->where('payment_status', 0)->first();
            if (isset($booking)) {
                return response()->json(['success' => false, 'message' => 'Account Can\'t Delete', 'data' => $booking]);
            }

            $user->name = 'Deleted User';
            $user->email = 'deleteduser_' . uniqid();
            $user->phone_no = '0000000000';
            $user->verified = 0;
            $user->status = 0;
            $user->save();

            Auth::guard('appuser')->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return response()->json(['success' => true, 'message' => 'Account Delete Successfully!', 'redirect_location' => url("/user_profile")]);
        }

        return response()->json(['success' => false, 'message' => 'Password Not Match']);
    }

    public function parkingSpaceBooking(Request $request)
    {
        $request->validate([
            'owner_id' => 'required',
            'space_id' => 'required',
            'user_id' => 'required',
            'arriving_time' => 'bail|required',
            'leaving_time' => 'bail|required|after:arriving_time',
            'vehicle_id' => 'required',
        ]);
        $parkingspace = $request->all();
        Session::put('parkingspace', $parkingspace);

        return redirect('/parking_slots');
    }

    public function parkingSlotBooking(Request $request)
    {
        $request->validate([
            'slot_id' => 'required'
        ]);
        $parkingslot = $request->all();

        session()->put('parkingslot', $parkingslot);

        return redirect('/checkout');
    }

    public function billing(Request $request)
    {
        $requestData = $request->all();
        $currency = AdminSetting::find(1)->currency;

        if (isset($requestData['payment_type']) && $requestData['payment_type'] == 'STRIPE') {
            $amount = $requestData['total_amount'] * 100;
            $stripe_sk = AdminSetting::first()->stripe_secret;
            $stripe = new StripeClient($stripe_sk);
            $charge = $stripe->charges->create([
                "amount" => $amount,
                "currency" => $currency,
                "source" => $requestData['payment_token'],
            ]);
            $requestData['payment_token'] = $charge->id;
        }

        $parkingBooking = ParkingBooking::create([
            'order_no' => uniqid(),
            'owner_id' => $requestData['owner_id'],
            'space_id' => $requestData['space_id'],
            'user_id' => $requestData['user_id'],
            'arriving_time' => $requestData['arriving_time'],
            'leaving_time' => $requestData['leaving_time'],
            'vehicle_id' => $requestData['vehicle_id'],
            'slot_id' => $requestData['slot_id'],
            'total_amount' => $requestData['total_amount'],
            'payment_token' => $requestData['payment_token'],
            'payment_type' => $requestData['payment_type'],
            'payment_status' => $requestData['payment_status'],
        ]);

        $parkingBooking->save();
        $request->session()->forget(['parkingspace', 'parkingslot']);
        return response()->json(['success' => true, 'message' => 'Parking booking successfully', 'redirect_location' => url("/display_parking_booking")]);
    }


    public function getOrderDetails($id)
    {
        $orderdetails = ParkingBooking::findOrFail($id);
        $setting = AdminSetting::first('currency');

        $arrivingTime = Carbon::parse($orderdetails->arriving_time);
        $leavingTime = Carbon::parse($orderdetails->leaving_time);

        $duration = $leavingTime->diff($arrivingTime);
        $dayDifference = $duration->d;
        $hourDifference = $duration->h;
        $minuteDifference = $duration->i;
        $secondDifference = $duration->s;

        $review = Review::where('space_id', $orderdetails->space_id)->where('user_id', Auth::guard('appuser')->user()->id)->get();

        $ordernumber = $orderdetails->id;
        $ordernumber = (string) $ordernumber;

        // Create QR code
        $qrcode = new QrCode($ordernumber);
        $qrcode->setEncoding(new Encoding('UTF-8'));
        $qrcode->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());
        $qrcode->setSize(300);
        $qrcode->setMargin(10);
        $qrcode->setRoundBlockSizeMode(new RoundBlockSizeModeMargin());
        $qrcode->setForegroundColor(new Color(0, 0, 0));
        $qrcode->setBackgroundColor(new Color(255, 255, 255));

        // Save QR code image to file
        $writer = new PngWriter();
        $result = $writer->write($qrcode)->getString();

        return view('website.orderdetails', compact('orderdetails', 'setting', 'hourDifference', 'review', 'qrcode', 'result', 'minuteDifference', 'secondDifference', 'dayDifference'));
    }

    public function review(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'space_id' => 'required',
            'star' => 'required',
            'description' => 'required'
        ]);
        $review = new Review;

        $review->user_id = $request->user_id;
        $review->space_id = $request->space_id;
        $review->star = $request->star;
        $review->description = $request->description;

        $review->save();
        return redirect()->back()->with('success', 'Thanks');
    }

    public function editReview(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'space_id' => 'required',
            'star' => 'required',
            'description' => 'required'
        ]);

        $review = Review::where('user_id', $request->user_id)
            ->where('space_id', $request->space_id)
            ->first();

        $review->star = $request->star;
        $review->description = $request->description;
        $review->save();
        return redirect()->back()->with('success', 'Review updated successfully');
    }

    public function bookingCancel($id)
    {
        $data = ParkingBooking::find($id);
        $data->status = 3;
        $data->save();
        return redirect('/display_parking_booking')->with('fail', 'Booking is cancel');
    }
}

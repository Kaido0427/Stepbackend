<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ParkingBooking;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class currencyConvertController extends Controller
{

    public function user_Convert(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $convertedAmounts = [];

        try {
            $user = Auth::user();
            // Vérifier si l'utilisateur est correctement authentifié
            if (!$user) {
                throw new Exception('Utilisateur non authentifié');
            }

            // Vérifier si l'utilisateur a des réservations
            $bookings = $user->bookings;

            if (!$bookings) {
                throw new Exception('L\'utilisateur n\'a pas de réservations.');
            }

            foreach ($bookings as $booking) {
                $amount = $booking->total_amount;

                // Arrondir à l'entier le plus proche 
                $roundedAmount = round($amount);

                // Convertir en chaîne
                $stringAmount = (string) $roundedAmount;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_PORT => "443",
                    CURLOPT_URL => "https://marketdata.tradermade.com/api/v1/convert?" . http_build_query(['from' => urlencode($from), 'to' => urlencode($to), 'amount' => $stringAmount, 'api_key' => 'N-6y6O5cmZFHlAnkhLPK']),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                // Vérification de l'erreur Curl
                if ($err) {
                    throw new Exception('Conversion API error: ' . $err);
                }

                // Vérification du code de réponse HTTP
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                if ($httpCode !== 200) {
                    throw new Exception('Conversion API error. HTTP Code: ' . $httpCode);
                }

                curl_close($curl);
                Log::debug('API Request: ' . print_r(curl_getinfo($curl), true));
                Log::debug('API Response: ' . $response);

                // Vérification du décodage JSON
                $convertedData = json_decode($response, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Failed to decode JSON response');
                }

                if (isset($convertedData['total'])) {
                    $convertedAmountValue = (float) $convertedData['total'];

                    $booking->setAttribute('total_amount', $convertedAmountValue);
                    $booking->save();


                    // Ajouter le montant converti au tableau
                    $convertedAmounts[] = $convertedAmountValue;
                } else {
                    error_log('Échec de la conversion pour la réservation avec ID ' . $booking->id);
                }
            }

            return response()->json([
                'message' => 'Montants convertis avec succès',
                'convertedAmounts' => $convertedAmounts
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function owner_Convert(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $convertedAmounts = [];

        try {
            $user = Auth::user();
            // Vérifier si l'utilisateur est correctement authentifié
            if (!$user) {
                throw new Exception('Utilisateur non authentifié');
            }

            // Vérifier si l'utilisateur a des réservations
            $spaces = $user->Spaces;

            if (!$spaces) {
                throw new Exception('L\'utilisateur n\'a pas de réservations.');
            }

            foreach ($spaces as $space) {
                $amount = $space->price_par_hour;

                // Arrondir à l'entier le plus proche 
                $roundedAmount = round($amount);

                // Convertir en chaîne
                $stringAmount = (string) $roundedAmount;

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_PORT => "443",
                    CURLOPT_URL => "https://marketdata.tradermade.com/api/v1/convert?" . http_build_query(['from' => urlencode($from), 'to' => urlencode($to), 'amount' => $stringAmount, 'api_key' => 'N-6y6O5cmZFHlAnkhLPK']),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                // Vérification de l'erreur Curl
                if ($err) {
                    throw new Exception('Conversion API error: ' . $err);
                }

                // Vérification du code de réponse HTTP
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                if ($httpCode !== 200) {
                    throw new Exception('Conversion API error. HTTP Code: ' . $httpCode);
                }

                curl_close($curl);
                Log::debug('API Request: ' . print_r(curl_getinfo($curl), true));
                Log::debug('API Response: ' . $response);

                // Vérification du décodage JSON
                $convertedData = json_decode($response, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Failed to decode JSON response');
                }

                if (isset($convertedData['total'])) {
                    $convertedAmountValue = (float) $convertedData['total'];

                    $space->setAttribute('price_par_hour', $convertedAmountValue);
                    $space->save();


                    // Ajouter le montant converti au tableau
                    $convertedAmounts[] = $convertedAmountValue;
                } else {
                    error_log('Échec de la conversion pour l\'espace avec ID ' . $space->id);
                }
            }

            return response()->json([
                'message' => 'Montants convertis avec succès',
                'convertedAmounts' => $convertedAmounts
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getConversionRate(Request $request)
    {


        try {
            // Initialisation de la requête à l'API pour récupérer le taux de change
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_PORT => "443",
                CURLOPT_URL => "https://marketdata.tradermade.com/api/v1/convert?" . http_build_query(['from' => 'EUR', 'to' => 'USD', 'amount' => 1, 'api_key' => 'N-6y6O5cmZFHlAnkhLPK']),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false
            ));

            // Exécution de la requête
            $response = curl_exec($curl);
            $err = curl_error($curl);

            // Gestion des erreurs
            if ($err) {
                throw new Exception('Conversion API error: ' . $err);
            }

            // Vérification du code de réponse HTTP
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($httpCode !== 200) {
                throw new Exception('Conversion API error. HTTP Code: ' . $httpCode);
            }

            curl_close($curl);

            // Vérification du décodage JSON
            $conversionData = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Failed to decode JSON response');
            }

            // Récupération du taux de change
            $conversionRate = $conversionData['total'];

            return response()->json([
                'message' => 'Taux de change récupéré avec succès',
                'conversionRate' => $conversionRate
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

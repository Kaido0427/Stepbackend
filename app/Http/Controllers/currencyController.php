<?php

namespace App\Http\Controllers;

use App\ParkingBooking;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;


class currencyController extends Controller
{


    public function convertAll(Request $request)
    {

        if($request->method() !== 'POST') {
            throw new \Exception('Requête invalide');
          }

        $from = $request->input('from');
        $to = $request->input('to');
        $convertedAmounts = [];



        try {
            $bookings = ParkingBooking::all();

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
                FacadesLog::debug('API Request: ' . print_r(curl_getinfo($curl), true));
                FacadesLog::debug('API Response: ' . $response);

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

            return redirect()->back()->with('success', 'Montants convertis avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

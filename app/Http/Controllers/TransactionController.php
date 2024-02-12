<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class TransactionController extends Controller
{
    /**
     * Handle transaction process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleTransaction(Request $request)
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            
            if ($request->has('token')) {
                // Success transaction
                $response = $provider->capturePaymentOrder($request->token);
                if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                    return response()->json(['message' => 'Transaction complete.']);
                } else {
                    return response()->json(['error' => $response['message'] ?? 'Something went wrong.'], 500);
                }
            } elseif ($request->has('cancel')) {
                // Cancel transaction
                return response()->json(['message' => 'You have canceled the transaction.']);
            } else {
                // Create transaction
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => [
                            "url" => "https://example.com/successTransaction",
                            "type" => "JSON"
                        ],
                        "cancel_url" => [
                            "url" => "https://example.com/cancelTransaction",
                            "type" => "JSON"
                        ],
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => "USD",
                                "value" => "1000.00"
                            ]
                        ]
                    ]
                ]);
                
                if (isset($response['id']) && $response['id'] != null) {
                    // Return approve URL
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return response()->json(['redirect_url' => $links['href']]);
                        }
                    }
                    return response()->json(['error' => 'Something went wrong.'], 500);
                } else {
                    return response()->json(['error' => $response['message'] ?? 'Something went wrong.'], 500);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}

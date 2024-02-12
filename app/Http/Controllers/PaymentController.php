<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{

    public function processPayment(Request $request)
    {
        try {
            $currency = $request->input('currency');

            if (!in_array($currency, ['USD', 'EUR'])) {
                throw new \InvalidArgumentException('Devise non prise en charge.');
            }

            

            $provider = new PayPalClient;

            // Créer une commande PayPal
            $response = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => $currency,
                            'value' => '10.00'
                        ],
                        'payee' => [
                            'email_address' => 'email_du_destinataire@exemple.com'
                        ]
                    ]
                ]
            ]);

            // Récupérer l'URL d'approbation PayPal
            $approvalUrl = $response['links'][1]['href']; // Assurez-vous que cet index soit correct selon la structure de votre réponse

            // Rediriger l'utilisateur vers l'URL d'approbation PayPal
            return redirect($approvalUrl);
        } catch (\Exception $e) {
            // Gérer les exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

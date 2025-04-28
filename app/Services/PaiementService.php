<?php

namespace App\Services;

use App\Models\Paiement;
use App\RepositoryInterfaces\PaiementRepositoryInterface;
use App\Services\Interfaces\PaiementServiceInterface;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PaymentFactureNotification;

class PaiementService implements PaiementServiceInterface
{
    protected $gateway;
    protected $paiementRepository;

    public function __construct(PaiementRepositoryInterface $paiementRepository)
    {
        $this->paiementRepository = $paiementRepository;
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function processPayment($amount, $user_id, $commande_id, $restaurant_id, $table_id)
    {

      
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => 'USD',
            'returnUrl' => "http://localhost:8000/api/payment/success?commande_id={$commande_id}&restaurant_id={$restaurant_id}&table_id={$table_id}",
            'cancelUrl' => 'http://localhost:8000/api/payment/error',
        ])->send();
        return $response->isRedirect()
            ? ['success' => true,  'redirect_url' => $response->getRedirectUrl()]
            : ['success' => false, 'message' => $response->getMessage()];
    }

    public function completePayment($payerId, $paymentId ,$commandeId, $restaurant_id, $table_id)
    {
        if (!$payerId || !$paymentId || !$commandeId) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètres manquants dans le retour PayPal.',
            ], 400);
        }
        $transaction = $this->gateway->completePurchase([
            'payerId' => $payerId,
            'transactionReference' => $paymentId,
            'commandeId' => $commandeId
        ])->send();

        $response = $transaction->getData();

        if (!$transaction->isSuccessful()) {
            return ['success' => false, 'message' => $transaction->getMessage()];
        }

        $paymentData = [
            'commande_id' => $commandeId,
            'montant' => $response['transactions'][0]['amount']['total'],
            'type' => 'paypal',
            'statut' => 'valide',
            'reference' => $response['id'],
            'dateTransaction' => now(),
        ];

        $payment = $this->paiementRepository->create($paymentData);

        if (Auth::check()) {
            Auth::user()->notify(new PaymentFactureNotification($payment));
        }
        if ($table_id == null) {
            $url =  "http://localhost:3000/Livraisons/{$restaurant_id}"; 
        }else {
            $url =  "http://localhost:3000/commandes/{$restaurant_id}/table/{$table_id}";
        }
        
        return redirect()->to($url)->with('success', 'Paiement réussi');
    }

    public function getAllPayments()
    {
        return $this->paiementRepository->getAll();
    }

}

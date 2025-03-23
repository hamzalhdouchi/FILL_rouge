<?php

namespace App\Services;

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

    public function processPayment($amount, $commandeId)
    {
        $response = $this->gateway->purchase([
            'amount' => $amount,
            'currency' => 'USD',
            'returnUrl' => route('api.payment.success'),
            'cancelUrl' => route('api.payment.error'),
        ])->send();

        return $response->isRedirect()
            ? ['success' => true, 'redirect_url' => $response->getRedirectUrl()]
            : ['success' => false, 'message' => $response->getMessage()];
    }

    public function completePayment($paymentId, $payerId, $commandeId)
    {
        $transaction = $this->gateway->completePurchase([
            'payer_id' => $payerId,
            'transactionReference' => $paymentId,
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

        return ['success' => true, 'message' => 'Paiement réussi', 'payment' => $payment];
    }

    public function getAllPayments()
    {
        return $this->paiementRepository->getAll();
    }
}

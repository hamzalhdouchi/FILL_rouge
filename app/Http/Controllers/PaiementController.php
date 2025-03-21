<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Notifications\PaymentFactureNotification;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    private $geteway;

    public function __construct()
    {
        $this->geteway = Omnipay::create('PayPal_Rest');
        $this->geteway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->geteway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->geteway->setTestMode(true);
    }

    public function pay(Request $request)
    {

       
        try {
            

            $response = $this->geteway->purchase(array(
                'amount' => $request->amount,
                'currency' => 'USD',
            'returnUrl' => Url('success'),
            'cancelUrl' => Url('error'),
            ))->send();

            if (true) {
                
                return redirect()->away($response->getRedirectUrl());
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }



    public function success(Request $request)
{
    if ($request->input('paymentId') && $request->input('PayerID')) {
        $transaction = $this->geteway->completePurchase([
            'payer_id' => $request->input('PayerID'),
            'transactionReference' => $request->input('paymentId'),
        ])->send();

        $response = $transaction->getData();

        if ($transaction->isSuccessful()) {
            $arr = $response;

            $payment = new Paiement();
            $payment->commande_id = $request->commande_id;
            $payment->montant = $arr['transactions'][0]['amount']['total'];
            $payment->type = 'paypal';
            $payment->statut = 'valide'; 
            $payment->reference = $arr['id'];
            $payment->dateTransaction = now();
            $payment->save();

            
            $user = auth()->user();
            $user->notify(new PaymentFactureNotification($payment));

            session()->flash('success', 'Payment successful');
            return to_route('readAll.properties');
        } else {
            session()->flash('error', $transaction->getMessage());
            return to_route('readAll.properties');
        }
    } else {
        session()->flash('error', 'Payment declined');
        return to_route('readAll.properties');
    }
}
    
    public function error()  {

        session()->flash('error','user dicline the payment');
        return to_route('readAll.properties');
    }

    public function readAllpayment()
    {
        $payments = Paiement::all();

        return view('payment',compact('payments'));
    }
}

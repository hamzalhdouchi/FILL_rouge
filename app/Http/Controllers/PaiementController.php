<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Paiement;
use App\Services\PaiementService;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    protected $paiementService;

    public function __construct(PaiementService $paiementService)
    {
        $this->paiementService = $paiementService;
    }

    public function pay(Request $request)
    {
        
        session([
            'paypal_user_id' => $request->user_id,
            'paypal_commande_id' => $request->commande_id,
        ]);
    
        $result = $this->paiementService->processPayment($request->amount, $request->user_id, $request->commande_id, $request->restaurant_id, $request->table_id);
        return response()->json($result, $result['success'] ? 200 : 400);
    }

    public function success(Request $request)
    {
        
        $commandeId = $request->input("commande_id");
        $payerId = $request->input("PayerID");

        $result = $this->paiementService->completePayment(
            $payerId,
            $request->input('paymentId'),
            $commandeId,
            $request->input('restaurant_id'),
            $request->input('table_id'),
        );
    
        return $result;
    }
    

    public function error(Request $request)
    {
        return response()->json(['success' => false, 'message' => 'Le paiement a échoué.'], 400);
    }

    public function allPayment()
    {
        $AllPayment = $this->paiementService->getAllPayments();
        return response()->json(['message' => 'the payment is recepre avec success','data' => $AllPayment]);
    }

}

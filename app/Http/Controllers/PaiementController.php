<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\paymentRequest;
use App\Services\Interfaces\PaiementServiceInterface;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    protected $paiementService;

    public function __construct(PaiementServiceInterface $paiementService)
    {
        $this->paiementService = $paiementService;
    }

    public function pay(paymentRequest $request)
    {
    
        $result = $this->paiementService->processPayment($request->amount, $request->commande_id);

        return response()->json($result, $result['success'] ? 200 : 400);
    }

    public function success(Request $request)
    {
        if (!$request->has(['paymentId', 'PayerID', 'commande_id'])) {
            return response()->json(['success' => false, 'message' => 'Paramètres manquants'], 400);
        }

        $result = $this->paiementService->completePayment(
            $request->input('paymentId'),
            $request->input('PayerID'),
            $request->input('commande_id')
        );

        return response()->json($result, $result['success'] ? 200 : 400);
    }

    public function error()
    {
        return response()->json(['success' => false, 'message' => 'Paiement annulé'], 400);
    }

    public function readAllPayments()
    {
        return response()->json([
            'success' => true,
            'payments' => $this->paiementService->getAllPayments()
        ], 200);
    }
}

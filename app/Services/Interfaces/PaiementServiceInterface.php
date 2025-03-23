<?php

namespace App\Services\Interfaces;

interface PaiementServiceInterface
{
    public function processPayment($amount, $commandeId);
    public function completePayment($paymentId, $payerId, $commandeId);
    public function getAllPayments();
}

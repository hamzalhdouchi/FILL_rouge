<?php

namespace App\Services\Interfaces;

interface PaiementServiceInterface
{
    public function processPayment($amount, $user_id, $commande_id, $restaurant_id, $table_id);
    public function completePayment($paymentId, $payerId, $commandeId, $restaurant_id, $table_id);
    public function getAllPayments();
}

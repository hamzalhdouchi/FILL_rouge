<?php

namespace App\Services;

interface StatistiqueServiceInterface
{
    public function totalUsers();
    public function newUsersToday();
    public function totalAcceptedRestaurants();
    public function totalRejectedRestaurants();
    public function totalReservations();
    public function totalPrixCommandes();
}

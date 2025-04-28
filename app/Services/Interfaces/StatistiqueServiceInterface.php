<?php

namespace App\Services\Interfaces;

interface StatistiqueServiceInterface
{
    public function totalUsers();
    public function newUsersToday();
    public function totalAcceptedRestaurants();
    public function totalRejectedRestaurants();
    public function totalReservations($id);
    public function totalPrixCommandes($id);
    public function totalPlat($id);
    public function totalCommande($id);

}

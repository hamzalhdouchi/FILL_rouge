<?php

namespace App\Repositories;

interface StatistiqueRepositoryInterface
{
    public function getTotalUsers();
    public function getNewUsersToday();
    public function getTotalAcceptedRestaurants();
    public function getTotalRejectedRestaurants();
    public function getTotalReservations();
    public function getTotalPrixCommandes();
}

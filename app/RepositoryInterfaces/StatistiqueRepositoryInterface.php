<?php

namespace App\RepositoryInterfaces;

interface StatistiqueRepositoryInterface
{
    public function getTotalUsers();
    public function getNewUsersToday();
    public function getTotalAcceptedRestaurants();
    public function getTotalRejectedRestaurants();
    public function getTotalReservations($id);
    public function getTotalPrixCommandes($id);
    public function getTotalPlats($id);
    public function getTotalCommandes($id);
}

<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistiqueRepository implements StatistiqueRepositoryInterface
{
    public function getTotalUsers()
    {
        return DB::table('users')->count();
    }

    public function getNewUsersToday()
    {
        $today = Carbon::today();
        return DB::table('users')
            ->whereDate('dateCreation', $today)
            ->count();
    }

    public function getTotalAcceptedRestaurants()
    {
        return DB::table('restaurants')
            ->where('status', 'accepted')
            ->count();
    }

    public function getTotalRejectedRestaurants()
    {
        return DB::table('restaurants')
            ->where('status', 'rejected')
            ->count();
    }

    public function getTotalReservations()
    {
        return DB::table('reservations')->count();
    }

    public function getTotalPrixCommandes()
    {
        return DB::table('commandes')->sum('prixTotal');
    }
}

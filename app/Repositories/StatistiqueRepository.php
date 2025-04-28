<?php

namespace App\Repositories;

use App\Models\Commande;
use App\Models\Plat;
use App\RepositoryInterfaces\StatistiqueRepositoryInterface;
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

    public function getTotalReservations($id)
    {
        return DB::table('reservations')->where('restaurant_id',$id)->count();
    }

    public function getTotalPrixCommandes($id)
    {
        return DB::table('commandes')->where('restaurant_id', $id)->sum('prixTotal');
    }

    public function getTotalPlats($id)
    {
        return Plat::where('menu_id', $id)->count();
    }

    public function getTotalCommandes($id)
    {
        return Commande::where('restaurant_id', $id)->count();
    }


}

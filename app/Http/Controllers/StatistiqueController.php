<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    public function totalUsers()
    {
        $total = DB::table('users')->count();

        return response()->json([
            'total_users' => $total,
        ]);
    }

    public function newUsersToday()
    {
        $today = Carbon::today();

        $newToday = DB::table('users')
            ->whereDate('dateCreation', $today)
            ->count();

        return response()->json([
            'new_users_today' => $newToday,
        ]);
    }



    public function totalAcceptedRestaurants()
    {
        $accepted = DB::table('restaurants')
            ->where('status', 'accepted')
            ->count();

        return response()->json([
            'total_accepted_restaurants' => $accepted,
        ]);
    }

    // 🔵 Nombre total de restaurants refusés
    public function totalRejectedRestaurants()
    {
        $rejected = DB::table('restaurants')
            ->where('status', 'rejected')
            ->count();

        return response()->json([
            'total_rejected_restaurants' => $rejected,
        ]);
    }

    public function totalReservations()
{
    $total = DB::table('reservations')->count();

    return response()->json([
        'total_reservations' => $total,
    ]);

}

public function totalPrixCommandes()
{
    $totalPrix = DB::table('commandes')->sum('prixTotal');

    return response()->json([
        'total_prix_commandes' => $totalPrix,
    ]);
}

}

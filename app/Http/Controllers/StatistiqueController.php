<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\StatistiqueServiceInterface;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    protected $statistiqueService;

    public function __construct(StatistiqueServiceInterface $statistiqueService)
    {
        $this->statistiqueService = $statistiqueService;
    }

    public function totalUsers()
    {
        return response()->json([
            'total_users' => $this->statistiqueService->totalUsers()
        ]);
    }

    public function newUsersToday()
    {
        return response()->json([
            'new_users_today' => $this->statistiqueService->newUsersToday()
        ]);
    }

    public function totalAcceptedRestaurants()
    {
        return response()->json([
            'total_accepted_restaurants' => $this->statistiqueService->totalAcceptedRestaurants()
        ]);
    }

    public function totalRejectedRestaurants()
    {
        return response()->json([
            'total_rejected_restaurants' => $this->statistiqueService->totalRejectedRestaurants()
        ]);
    }

    public function totalReservations($id)
    {
        return response()->json([
            'total_reservations' => $this->statistiqueService->totalReservations($id)
        ]);
    }

    public function totalPrixCommandes($id)
    {
        return response()->json([
            'total_prix_commandes' => $this->statistiqueService->totalPrixCommandes($id)
        ]);
    }

    public function totalPlat($id)
    {
        $total = $this->statistiqueService->totalPlat($id);

        return response()->json([
            'total' => $total
        ]);
    }

    public function totalCommande($id)
    {
        $total = $this->statistiqueService->totalCommande($id);

        return response()->json([
            'total' => $total
        ]);
    }

}

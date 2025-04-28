<?php

namespace App\Services;

use App\RepositoryInterfaces\StatistiqueRepositoryInterface;
use App\Services\Interfaces\StatistiqueServiceInterface;
use Carbon\Carbon;
class StatistiqueService implements StatistiqueServiceInterface
{
    protected $repository;

    public function __construct(StatistiqueRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function totalUsers()
    {
        return $this->repository->getTotalUsers();
    }

    public function newUsersToday()
    {
        return $this->repository->getNewUsersToday();
    }

    public function totalAcceptedRestaurants()
    {
        return $this->repository->getTotalAcceptedRestaurants();
    }

    public function totalRejectedRestaurants()
    {
        return $this->repository->getTotalRejectedRestaurants();
    }

    public function totalReservations($id)
    {
        return $this->repository->getTotalReservations($id);
    }

    public function totalPrixCommandes($id)
    {
        return $this->repository->getTotalPrixCommandes($id);
    }

    
    public function totalPlat($id)
    {
        return $this->repository->getTotalPlats($id);
    }

    public function totalCommande($id): int
    {
        return $this->repository->getTotalCommandes($id);
    }
}


<?php

namespace App\Services;

use App\RepositoryInterfaces\StatistiqueRepositoryInterface;

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

    public function totalReservations()
    {
        return $this->repository->getTotalReservations();
    }

    public function totalPrixCommandes()
    {
        return $this->repository->getTotalPrixCommandes();
    }
}

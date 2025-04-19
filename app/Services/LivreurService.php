<?php
namespace App\Services;

use App\RepositoryInterfaces\LivreurRepositoryInterface;
use App\Services\Interfaces\LivreurServiceInterface;

class LivreurService implements LivreurServiceInterface
{
    protected $livreurRepository;

    public function __construct(LivreurRepositoryInterface $livreurRepository)
    {
        $this->livreurRepository = $livreurRepository;
    }

    public function getAllLivreurs()
    {
        return $this->livreurRepository->all();
    }

    public function getLivreurById($id)
    {
        return $this->livreurRepository->find($id);
    }

    public function createLivreur(array $data)
    {
        return $this->livreurRepository->create($data);
    }

    public function updateLivreur($id, array $data)
    {
        return $this->livreurRepository->update($id, $data);
    }

    public function deleteLivreur($id)
    {
        return $this->livreurRepository->delete($id);
    }
}
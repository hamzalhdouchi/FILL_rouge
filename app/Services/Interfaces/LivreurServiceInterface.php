<?php
namespace App\Services\Interfaces;

interface LivreurServiceInterface
{
    public function getAllLivreurs();
    public function getLivreurById($id);
    public function createLivreur(array $data);
    public function updateLivreur($id, array $data);
    public function deleteLivreur($id);
}
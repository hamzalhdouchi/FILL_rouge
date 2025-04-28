<?php

namespace App\Services;

use App\Models\Categorie;
use App\Services\Interfaces\CategorieServiceInterface;
use App\RepositoryInterfaces\CategorieRepositoryInterface;

class CategorieService implements CategorieServiceInterface
{
    protected $categorieRepository;

    public function __construct(CategorieRepositoryInterface $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }

    public function getAllCategories($id)
    {
        return $this->categorieRepository->getAll($id);
    }

    public function getCategoryById($id)
    {
        return $this->categorieRepository->findById($id);
    }

    public function createCategory( $data)
    {
        return $this->categorieRepository->create($data);
    }

    public function updateCategory( $id,  $data)
    {
        return $this->categorieRepository->update($id, $data);
    }

    public function deleteCategory(Categorie $category)
    {
        return $this->categorieRepository->delete($category);
    }
}

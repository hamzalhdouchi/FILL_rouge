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

    public function getAllCategories()
    {
        return $this->categorieRepository->getAll();
    }

    public function getCategoryById($id)
    {
        return $this->categorieRepository->findById($id);
    }

    public function createCategory( $data)
    {
        return $this->categorieRepository->create($data);
    }

    public function updateCategory(Categorie $category,  $data)
    {
        return $this->categorieRepository->update($category, $data);
    }

    public function deleteCategory(Categorie $category)
    {
        return $this->categorieRepository->delete($category);
    }
}

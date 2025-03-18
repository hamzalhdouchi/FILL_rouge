<?php

namespace App\Services\Interfaces;

use App\Models\Categorie;

interface CategorieServiceInterface
{
    public function getAllCategories();
    public function getCategoryById($id);
    public function createCategory(array $data);
    public function updateCategory(Categorie $category, array $data);
    public function deleteCategory(Categorie $category);
}

<?php

namespace App\Services\Interfaces;

use App\Models\Categorie;

interface CategorieServiceInterface
{
    public function getAllCategories($id);
    public function getCategoryById($id);
    public function createCategory( $data);
    public function updateCategory( $id,  $data);
    public function deleteCategory(Categorie $category);
}

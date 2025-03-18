<?php

namespace App\RepositoryInterfaces;

use App\Models\Categorie;

interface CategorieRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update(Categorie $category, array $data);
    public function delete(Categorie $category);
}

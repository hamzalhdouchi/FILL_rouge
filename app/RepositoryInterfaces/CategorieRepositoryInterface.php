<?php

namespace App\RepositoryInterfaces;

use App\Models\Categorie;

interface CategorieRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create( $data);
    public function update(Categorie $category,  $data);
    public function delete(Categorie $category);
}

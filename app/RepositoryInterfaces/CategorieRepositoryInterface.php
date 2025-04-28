<?php

namespace App\RepositoryInterfaces;

use App\Models\Categorie;

interface CategorieRepositoryInterface
{
    public function getAll($id);
    public function findById($id);
    public function create( $data);
    public function update( $id,  $data);
    public function delete(Categorie $category);
}

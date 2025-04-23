<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\RepositoryInterfaces\CategorieRepositoryInterface;

class CategorieRepository implements CategorieRepositoryInterface
{
    public function getAll()
    {
        return Categorie::with('plat')->get();
    }

    public function findById($id)
    {
        return Categorie::find($id);
    }

    public function create( $data)
    {
        return Categorie::create($data);
    }

    public function update(Categorie $category,  $data)
    {
        return $category->update($data);
    }

    public function delete(Categorie $category)
    {
        return $category->delete();
    }
}

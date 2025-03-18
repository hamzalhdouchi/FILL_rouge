<?php

namespace App\Repositories;

use App\Models\Categorie;
use App\RepositoryInterfaces\CategorieRepositoryInterface;

class CategorieRepository implements CategorieRepositoryInterface
{
    public function getAll()
    {
        return Categorie::all();
    }

    public function findById($id)
    {
        return Categorie::find($id);
    }

    public function create(array $data)
    {
        return Categorie::create($data);
    }

    public function update(Categorie $category, array $data)
    {
        return $category->update($data);
    }

    public function delete(Categorie $category)
    {
        return $category->delete();
    }
}

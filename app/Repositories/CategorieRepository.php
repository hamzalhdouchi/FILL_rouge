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

    public function update($id, $data)
    {
        $categorie = Categorie::findOrFail($id);
        
        $update = $categorie->update($data);
        
        return $update; 
    }

    public function delete(Categorie $category)
    {
        $category = Categorie::findOrFail($category->id);
    $category->plat()->delete(); 
    $category->delete(); 
        return $category->delete();
    }
}

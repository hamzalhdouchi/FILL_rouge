<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\Repositories\Interfaces\IngredientRepositoryInterface;

class IngredientRepository implements IngredientRepositoryInterface
{
    public function ajouterIngredient(array $data)
    {
        $ingredient = Ingredient::create($data);
        return $ingredient;
    }

    public function afficherIngredient()
    {
        return Ingredient::all();
    }

    public function modifierIngredient($id, array $data)
    {
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            $ingredient->update($data);
            return $ingredient;
        }
        return null;
    }

    public function supprimerIngredient($id)
    {
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            $ingredient->delete();
            return true;
        }
        return false;
    }

    public function mettreAJourStock($id, $quantite)
    {
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            $ingredient->quantite = $quantite;
            $ingredient->save();
            return $ingredient;
        }
        return null;
    }

    public function verifierDisponibilite($id)
    {
        return Ingredient::find($id);
    }
}

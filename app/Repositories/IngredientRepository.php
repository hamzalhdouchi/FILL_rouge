<?php

namespace App\Repositories;

use App\Models\Ingredient;
use App\RepositoryInterfaces\IngredientRepositoryInterface;

class IngredientRepository implements IngredientRepositoryInterface
{
    public function ajouterIngredient( $data)
    {
        foreach ($data as $ingredient) {  
            Ingredient::create([
                'nom_ingredient' => $ingredient['nom_ingredient'],
                'stock' => $ingredient['stock'],
                'unite_mesure' => $ingredient['unite_mesure'],
                'restaurants_id' => $ingredient['restaurants_id']
            ]);
        }
        return response()->json(['message' => 'Ingrédients enregistrés avec succès !'], 201);
}

    public function afficherIngredient($id)
    {
        return Ingredient::where('restaurants_id', $id)->get();
    }

    public function modifierIngredient($id,  $data)
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
            $ingredient->stock = $quantite;
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

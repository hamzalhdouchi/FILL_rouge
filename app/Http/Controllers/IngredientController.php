<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function store(Request $request)
    {
        $ingredient = new Ingredient();
        return $ingredient->ajouterIngredient($request->all());
    }

    public function index()
    {
        $ingredient = new Ingredient();
        return $ingredient->afficherIngredient();
    }

    public function update(Request $request, $id)
    {
        $ingredient = new Ingredient();
        return $ingredient->modifierIngredient($id, $request->all());
    }

    public function destroy($id)
    {
        $ingredient = new Ingredient();
        return $ingredient->supprimerIngredient($id);
    }

    public function mettreAJourStock(Request $request, $id)
    {
        $ingredient = new Ingredient();
        return $ingredient->mettreAJourStock($id, $request->quantite);
    }

    public function verifierDisponibilite($id)
    {
        $ingredient = new Ingredient();
        return $ingredient->verifierDisponibilite($id);
    }
}
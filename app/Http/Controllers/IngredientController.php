<?php

namespace App\Http\Controllers;

use App\Http\Requests\mettreAJouringredient;
use App\Http\Requests\mettreAJourStock;
use App\Http\Requests\storeIngredients;
use App\Services\Interfaces\IngredientServiceInterface;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    protected $ingredientservice;

    public function __construct(IngredientServiceInterface $ingredient)
    {
        $this->ingredientservice = $ingredient;
    }

    public function store(storeIngredients $request)
    {
        $data = $request->ingredients;
        $ingredient = $this->ingredientservice->ajouterIngredient($data);
        return $ingredient;
    }

    public function index($id)
    {
        $ingredient = $this->ingredientservice->afficherIngredient($id);
        return $ingredient;
    }

    public function update(mettreAJouringredient $request, $id)
    {
        $data = $request->all();
        $ingredient = $this->ingredientservice->modifierIngredient($id, $data);
        return $ingredient;
    }

    public function destroy($id)
    {
        $ingredient = $this->ingredientservice->supprimerIngredient($id);
        return $ingredient;
    }

    public function mettreAJourStock(mettreAJourStock $request, $id)
    {
        $data = $request->stock;
        $ingredient = $this->ingredientservice->mettreAJourStock($id, $data);
        return $ingredient;
    }

    public function verifierDisponibilite($id)
    {
        $ingredient = $this->ingredientservice->verifierDisponibilite($id);
        return $ingredient;
    }
}
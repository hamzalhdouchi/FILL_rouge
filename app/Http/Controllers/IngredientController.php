<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IngredientServiceInterface;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    protected $IngredientService;

    public function __construct(IngredientServiceInterface $ingredient)
    {
        $this->ingredientService = $ingredient;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $ingredient = $this->IngredientService->ajouterIngredient($data);
        return $ingredient;
    }

    public function index()
    {
        $ingredient = $this->IngredientService->afficherIngredient();
        return $ingredient;
    }

    public function update(Request $request, $id)
    {
        $ingredient = $this->IngredientService->modifierIngredient($id, $request->all());
        return $ingredient;
    }

    public function destroy($id)
    {
        $ingredient = $this->IngredientService->supprimerIngredient($id);
        return $ingredient;
    }

    public function mettreAJourStock(Request $request, $id)
    {
        $ingredient = $this->IngredientService->mettreAJourStock($id, $request->quantite);
        return $ingredient;
    }

    public function verifierDisponibilite($id)
    {
        $ingredient = $this->IngredientService->verifierDisponibilite($id);
        return $ingredient;
    }
}
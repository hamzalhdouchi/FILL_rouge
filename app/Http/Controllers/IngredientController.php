<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Services\IngredientService;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    protected $ingredientService;

    public function __construct(IngredientService $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }

    public function ajouterIngredient(Request $request)
    {
        $result = $this->ingredientService->ajouterIngredient($request->all());
        return response()->json($result);
    }

    public function afficherIngredient()
    {
        $result = $this->ingredientService->afficherIngredient();
        return response()->json($result);
    }

    public function modifierIngredient(Request $request, $id)
    {
        $result = $this->ingredientService->modifierIngredient($id, $request->all());
        return response()->json($result);
    }

    public function supprimerIngredient($id)
    {
        $result = $this->ingredientService->supprimerIngredient($id);
        return response()->json($result);
    }

    public function mettreAJourStock(Request $request, $id)
    {
        $result = $this->ingredientService->mettreAJourStock($id, $request->quantite);
        return response()->json($result);
    }

    public function verifierDisponibilite($id)
    {
        $result = $this->ingredientService->verifierDisponibilite($id);
        return response()->json($result);
    }
}

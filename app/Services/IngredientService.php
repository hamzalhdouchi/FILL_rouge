<?php

namespace App\Services;

use App\RepositoryInterfaces\IngredientRepositoryInterface;
use App\Services\Interfaces\IngredientServiceInterface;

class IngredientService implements IngredientServiceInterface
{
    protected $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function ajouterIngredient($data)
    {
        $ingredient = $this->ingredientRepository->ajouterIngredient($data);
        return  $ingredient;
    }

    public function afficherIngredient($id)
    {
        return $this->ingredientRepository->afficherIngredient($id);
    }

    public function modifierIngredient($id, $data)
    {
        $ingredient = $this->ingredientRepository->modifierIngredient($id, $data);
        if ($ingredient) {
            return [
                'message' => 'Ingrédient mis à jour avec succès.',
                'ingredient' => $ingredient
            ];
        }
        return ['message' => 'Ingrédient non trouvé.'];
    }

    public function supprimerIngredient($id)
    {
        $result = $this->ingredientRepository->supprimerIngredient($id);
        if ($result) {
            return ['message' => 'Ingrédient supprimé avec succès.'];
        }
        return ['message' => 'Ingrédient non trouvé.'];
    }

    public function mettreAJourStock($id, $quantite)
    {
        $ingredient = $this->ingredientRepository->mettreAJourStock($id, $quantite);
        if ($ingredient) {
            return [
                'message' => 'Stock mis à jour avec succès.',
                'ingredient' => $ingredient
            ];
        }
        return ['message' => 'Ingrédient non trouvé.'];
    }

    public function verifierDisponibilite($id)
    {
        $ingredient = $this->ingredientRepository->verifierDisponibilite($id);
        if ($ingredient) {
            return [
                'message' => 'Ingrédient trouvé.',
                'ingredient' => $ingredient
            ];
        }
        return ['message' => 'Ingrédient non trouvé.'];
    }
}

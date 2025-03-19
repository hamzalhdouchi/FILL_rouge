<?php

namespace App\Services;

use App\RepositoryInterfaces\IngredientRepositoryInterface;

class IngredientService
{
    protected $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function ajouterIngredient(array $data)
    {
        $ingredient = $this->ingredientRepository->ajouterIngredient($data);
        return [
            'message' => 'Ingrédient ajouté avec succès.',
            'ingredient' => $ingredient
        ];
    }

    public function afficherIngredient()
    {
        return $this->ingredientRepository->afficherIngredient();
    }

    public function modifierIngredient($id, array $data)
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

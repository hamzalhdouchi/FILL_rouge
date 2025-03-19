<?php

namespace App\Services\Interfaces;

interface IngredientServiceInterface
{
    public function ajouterIngredient(array $data);
    public function afficherIngredient();
    public function modifierIngredient($id, array $data);
    public function supprimerIngredient($id);
    public function mettreAJourStock($id, $quantite);
    public function verifierDisponibilite($id);
}

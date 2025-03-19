<?php

namespace App\Services\Interfaces;

interface IngredientServiceInterface
{
    public function ajouterIngredient( $data);
    public function afficherIngredient();
    public function modifierIngredient($id,  $data);
    public function supprimerIngredient($id);
    public function mettreAJourStock($id, $quantite);
    public function verifierDisponibilite($id);
}

<?php

namespace App\Services\Interfaces;

interface PlatServiceInterface
{
    public function ajouterPlat( $data);
    public function affichePlats();
    public function modifierPlat($id,  $data);
    public function supprimerPlat($id);
    public function changerDisponibilite($id, $disponible);
}

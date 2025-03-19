<?php

namespace App\RepositoryInterfaces;

interface PlatRepositoryInterface
{
    public function ajouterPlat( $data);
    public function affichePlats();
    public function modifierPlat($id,  $data);
    public function supprimerPlat($id);
    public function changerDisponibilite($id, $disponible);
}

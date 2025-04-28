<?php

namespace App\RepositoryInterfaces;

interface PlatRepositoryInterface
{
    public function ajouterPlat( $data);
    public function affichePlats($id);
    public function modifierPlat($id, array $data);
    public function supprimerPlat($id);
    public function changerDisponibilite($id, $disponible);
}

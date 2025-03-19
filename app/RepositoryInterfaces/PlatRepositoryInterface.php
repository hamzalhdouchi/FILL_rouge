<?php

namespace App\RepositoryInterfaces;

interface PlatRepositoryInterface
{
    public function ajouterPlat(array $data);
    public function affichePlats();
    public function modifierPlat($id, array $data);
    public function supprimerPlat($id);
    public function changerDisponibilite($id, $disponible);
}

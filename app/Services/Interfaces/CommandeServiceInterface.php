<?php

namespace App\Services\Interfaces;

interface CommandeServiceInterface
{
    public function passerCommande(array $data);
    public function getCommandes();
    public function annulerCommande($id);
    public function evaluerService($id, $note);
    public function calculerTotal($id);
    public function calculerSousTotal($id);
    public function changerStatut($id, $statut);
    public function genererFacture($id);
}

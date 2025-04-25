<?php

namespace App\Services\Interfaces;

interface CommandeServiceInterface
{
    public function passerCommande( $data);
    public function getCommandes($id);
    public function annulerCommande($id);
    public function evaluerService($id, $note);
    public function calculerTotal($id);
    public function calculerSousTotal($id);
    public function changerStatut($id, $statut);
    public function genererFacture($id);

    public function getCommendById($restaurant_id, $table_id);
    public function getAllCommandes($restaurant_id);
    
    public function deleteCommande($id);


}

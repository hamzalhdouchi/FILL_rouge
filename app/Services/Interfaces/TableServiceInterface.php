<?php
namespace App\Services\Interfaces;

interface TableServiceInterface
{
    public function AjouterTable($id_Restaurant, $data);
    public function afficheriAllTables($id_Restaurant);
    public function afficherTable($id_Restaurant, $idTable);
    public function ModifierTable($id_Restaurant, $data);
    public function supprimerTable($id_Restaurant, $idTable);
    public function ShowLesTableDisponibile($id_Restaurant);
}
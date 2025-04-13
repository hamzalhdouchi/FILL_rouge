<?php 

namespace App\Repositories;

use App\Http\Controllers\QRcodeController;
use App\Models\Restaurant;
use App\Models\Table;
use App\RepositoryInterfaces\TableReposetoryInterface;

class TableRepository implements TableReposetoryInterface
{
    public function AjouterTable($id_Restaurant, $data)
    {
        $data['restaurant_id'] = $id_Restaurant;
        $qrcode = QRcodeController::class;
        $table = Table::create($data);
        $generatit = $qrcode->generateQrCode();
        return $table;
    }

    public function afficheriAllTables($id_Restaurant)
    {
        return Table::where('restaurant_id', $id_Restaurant)->get();
    }

    public function afficherTable($id_Restaurant, $idTable)
    {
        return Table::where('restaurant_id', $id_Restaurant)->where('id', $idTable)->first();
    }

    public function ModifierTable($id_Restaurant, $data)
    {
        $table = Table::where('restaurant_id', $id_Restaurant)->where('id', $data['id'])->first();
        if ($table) {
            $table->update($data);
            return $table;
        }
        return null;
    }

    public function supprimerTable($id_Restaurant, $idTable)
    {
        return Table::where('restaurant_id', $id_Restaurant)->where('id', $idTable)->delete();
    }

    public function ShowLesTableDisponibile($id_Restaurant)
    {
        return Table::where('restaurant_id', $id_Restaurant)->where('statut', 'libre')->get();
    }
}
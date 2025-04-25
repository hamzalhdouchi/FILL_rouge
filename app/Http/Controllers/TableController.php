<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\TableServiceInterface;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $tableService;

    public function __construct(TableServiceInterface $tableService)
    {
        $this->tableService = $tableService;
    }

    public function store(Request $request, $id_Restaurant)
    {
        return $this->tableService->AjouterTable($id_Restaurant, $request->all());
    }

    public function index($id_Restaurant)
    {
        return $this->tableService->afficheriAllTables($id_Restaurant);
    }

    public function show($id_Restaurant, $idTable)
    {
        return $this->tableService->afficherTable($id_Restaurant, $idTable);
    }

    public function update(Request $request, $id_Restaurant, $idTable)
    {
        return $this->tableService->ModifierTable($id_Restaurant, $request->all(), $idTable);
    }

    public function destroy($id_Restaurant, $idTable)
    {
        return $this->tableService->supprimerTable($id_Restaurant, $idTable);
    }

    public function availableTables($id_Restaurant)
    {
        return $this->tableService->ShowLesTableDisponibile($id_Restaurant);
    }
}

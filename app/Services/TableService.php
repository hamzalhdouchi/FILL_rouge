<?php 

namespace App\Services;

use App\Repositories\TableRepository;
use App\Services\Interfaces\TableServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TableService implements TableServiceInterface
{
    protected $tableRepository;

    public function __construct(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function AjouterTable($id_Restaurant, $data)
    {
        return response()->json(['success' => true, 'data' => $this->tableRepository->AjouterTable($id_Restaurant, $data)], 201);
    }

    public function afficheriAllTables($id_Restaurant)
    {
        return response()->json(['success' => true, 'data' => $this->tableRepository->afficheriAllTables($id_Restaurant)], 200);
    }

    public function afficherTable($id_Restaurant, $idTable)
    {
        $tables =  $this->tableRepository->afficherTable($id_Restaurant, $idTable);
        if (!$tables) {
            return response()->json(['message'=> 'les table pas trouve'],404);
        }

        return response()->json( ['message'=> 'Table trouve successfully','data'=> $tables],200);
    }

    public function ModifierTable($id_Restaurant, $data)
    {

        $updateTable = $this->tableRepository->ModifierTable($id_Restaurant, $data);
        if (!$updateTable) {
            return response()->json(['success' => false, 'error' => 'Table non trouvée'], 404);
        }
            return response()->json(['success' => true, 'message' => 'the upDate is successFully'], 200);

    }

    public function supprimerTable($id_Restaurant, $idTable)
    {
        $deleted = $this->tableRepository->supprimerTable($id_Restaurant, $idTable);
        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Table supprimée avec succès'], 200);
        }
        return response()->json(['success' => false, 'error' => 'Table non trouvée'], 404);
    }

    public function ShowLesTableDisponibile($id_Restaurant)
    {
        return response()->json(['success' => true, 'data' => $this->tableRepository->ShowLesTableDisponibile($id_Restaurant)], 200);
    }
}
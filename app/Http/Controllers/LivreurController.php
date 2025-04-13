<?php
namespace App\Http\Controllers;

use App\Services\Interfaces\LivreurServiceInterface;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
    protected $livreurService;

    public function __construct(LivreurServiceInterface $livreurService)
    {
        $this->livreurService = $livreurService;
    }

    public function index()
    {
        $livreurs = $this->livreurService->getAllLivreurs();
        return response()->json($livreurs);
    }

    public function store(Request $request)
    {
        $validated = $request->validateed();

        $livreur = $this->livreurService->createLivreur($validated);
        
        return response()->json([
            'message' => 'Livreur ajouté avec succès !',
            'data' => $livreur
        ], 201);
    }

    public function show($id)
    {
        $livreur = $this->livreurService->getLivreurById($id);
        return response()->json($livreur);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validateed();

        $livreur = $this->livreurService->updateLivreur($id, $validated);
        
        return response()->json([
            'message' => 'Livreur mis à jour avec succès',
            'data' => $livreur
        ]);
    }

    public function destroy($id)
    {
        $this->livreurService->deleteLivreur($id);
        return response()->json(['message' => 'Livreur supprimé avec succès']);
    }
}
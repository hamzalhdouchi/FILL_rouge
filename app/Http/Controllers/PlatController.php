<?php

namespace App\Http\Controllers;


use App\Http\Requests\PlatResquest;
use App\Services\Interfaces\PlatServiceInterface;
use Illuminate\Http\Request;

class PlatController extends Controller
{
    protected $platService;

    public function __construct(PlatServiceInterface $platService)
    {
        $this->platService = $platService;
    }

    public function ajouterPlats(PlatResquest $request)
    {
        $response = $this->platService->ajouterPlat($request);
        return response()->json($response);
    }

    public function affichePlats()
    {
        $response = $this->platService->affichePlats();
        return response()->json($response);
    }

    public function modifierPlats(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'string|max:255',
            'prix' => 'numeric',
        ]);
        $response = $this->platService->modifierPlat($id, $validated);
        return response()->json($response);
    }

    public function supprimerPlats($id)
    {
        $response = $this->platService->supprimerPlat($id);
        return response()->json($response);
    }

    public function modifierPlot(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'string|max:255',
            'prix' => 'numeric',
        ]);
        $response = $this->platService->modifierPlat($id, $validated);
        return response()->json($response);
    }

    public function changerDisponibilite(Request $request, $id)
    {
        $validated = $request->validate([
            'disponible' => 'required|boolean',
        ]);
        $response = $this->platService->changerDisponibilite($id, $validated['disponible']);
        return response()->json($response);
    }
}

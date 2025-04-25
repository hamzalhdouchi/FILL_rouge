<?php

namespace App\Http\Controllers;


use App\Http\Requests\plateUpdateRequest;
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

    public function store(PlatResquest $request)
    {
        $response = $this->platService->ajouterPlat($request);
        return response()->json($response);
    }

    public function index(Request $request)
    {
        $response = $this->platService->affichePlats($request['menu_id']);
        return response()->json($response);
    }

    public function update(plateUpdateRequest $request, $id)
    {
        
        $response = $this->platService->modifierPlat($id, $request);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $response = $this->platService->supprimerPlat($id);
        return response()->json($response);
    }

    public function changerDisponibilite(Request $request, $id)
    {
        
        $response = $this->platService->changerDisponibilite($id, $request['disponible']);
        return response()->json($response);
    }
}

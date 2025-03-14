<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreResquest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreResquest $request)
    {
        $validatedData = $request->validated();

        $utilisateur = User::create($validatedData);

        return response()->json($utilisateur, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $utilisateur = User::findOrFail($id);

        $utilisateur->delete();
    
        return response()->json([
            'message' => 'Compte utilisateur supprimé avec succès'
        ], 200);
    }

    public function changeStatus(Request $request, $id)
{
    $request->validate([
        'statut' => 'required|in:actif,inactif',
    ]);

    $utilisateur = User::findOrFail($id);

    $utilisateur->statut = $request->statut;
    $utilisateur->save();

    return response()->json([
        'message' => 'Statut mis à jour avec succès',
        'utilisateur' => $utilisateur
    ], 200);
}
}

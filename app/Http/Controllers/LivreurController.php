<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LivreurController extends Controller
{
    /**
     * Affiche la liste de tous les livreurs.
     */
    public function index()
    {
        $livreurs = DB::table('livreur')->get();
        return response()->json($livreurs);
    }

    /**
     * Enregistre un nouveau livreur.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_utilisateur' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'vehicule' => 'required|string',
            'zone' => 'required|string',
        ]);

        DB::statement("SELECT insert_livreur(?, ?, ?, ?, ?, ?)", [
            $validated['nom_utilisateur'],
            $validated['prenom'],
            $validated['email'],
            bcrypt($validated['password']),
            $validated['vehicule'],
            $validated['zone']
        ]);

        return response()->json(['message' => 'Livreur ajouté avec succès !'], 201);
    }

    /**
     * Affiche un livreur par ID.
     */
    public function show($id)
    {
        $livreur = DB::table('livreur')->where('id', $id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Livreur non trouvé'], 404);
        }

        return response()->json($livreur);
    }

    /**
     * Met à jour les informations d’un livreur.
     */
    public function update(Request $request, $id)
    {
        $livreur = DB::table('livreur')->where('id', $id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Livreur non trouvé'], 404);
        }

        $validated = $request->validate([
            'nom_utilisateur' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'vehicule' => 'sometimes|string',
            'zone' => 'sometimes|string',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        DB::table('livreur')->where('id', $id)->update($validated);

        return response()->json(['message' => 'Livreur mis à jour avec succès']);
    }

    /**
     * Supprime un livreur.
     */
    public function destroy($id)
    {
        $livreur = DB::table('livreur')->where('id', $id)->first();

        if (!$livreur) {
            return response()->json(['message' => 'Livreur non trouvé'], 404);
        }

        DB::table('livreur')->where('id', $id)->delete();

        return response()->json(['message' => 'Livreur supprimé avec succès']);
    }
}

}

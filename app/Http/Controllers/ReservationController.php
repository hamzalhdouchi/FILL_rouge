<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Liste de toutes les réservations
    public function index()
    {
        return response()->json(Reservation::all(), 200);
    }

    // Ajouter une réservation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
            'preorder_check' => 'boolean',
        ]);

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    // Afficher une réservation spécifique
    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        return response()->json($reservation, 200);
    }

    // Mettre à jour une réservation
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required',
            'guests' => 'sometimes|required|integer|min:1',
            'special_requests' => 'nullable|string',
            'preorder_check' => 'boolean',
        ]);

        $reservation->update($validated);

        return response()->json($reservation, 200);
    }

    // Supprimer une réservation
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès'], 200);
    }
}

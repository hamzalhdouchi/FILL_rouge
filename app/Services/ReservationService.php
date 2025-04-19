<?php

namespace App\Services;

use App\RepositoryInterfaces\ReservationRepositoryInterface;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationService implements ReservationServiceInterface
{
    protected $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function getAll()
    {
        $reservations = $this->reservationRepository->all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des réservations récupérée avec succès.',
            'data' => $reservations
        ], 200);
    }

    public function getById($id)
    {
        $reservation = $this->reservationRepository->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Réservation récupérée avec succès.',
            'data' => $reservation
        ], 200);
    }

    public function create(array $data)
    {
        $reservation = $this->reservationRepository->create($data);
        return response()->json([
            'success' => true,
            'message' => 'Réservation créée avec succès.',
            'data' => $reservation
        ], 201);
    }

    public function update($id, array $data)
    {
        $reservation = $this->reservationRepository->update($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Réservation mise à jour avec succès.',
            'data' => $reservation
        ], 200);
    }

    public function delete($id)
    {
        $this->reservationRepository->delete($id);
        return response()->json([
            'success' => true,
            'message' => 'Réservation supprimée avec succès.'
        ], 200);
    }
}

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

    public function getAll($id_Restaurant)
    {
        $reservations = $this->reservationRepository->all($id_Restaurant);
        return response()->json([
            'success' => true,
            'message' => 'Liste des réservations récupérée avec succès.',
            'data' => $reservations
        ], 200);
    }
    

    public function getById()
    {
        $reservation = $this->reservationRepository->find();
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

    public function delete($id, $id_Restaurant)
    {
        $this->reservationRepository->delete($id, $id_Restaurant);
        return response()->json([
            'success' => true,
            'message' => 'Réservation supprimée avec succès.'
        ], 200);
    }

    public function reservation($id)
    {
        $reservation = $this->reservationRepository->UserReservatuion($id);
        if ($reservation == null) {
            return response()->json(['message'=> 'we dont have reservation',$reservation], 404);
        }
        

        return response()->json(['message'=> 'the reservation is recepered','data' => $reservation],200);
    }

    public function changeStatus($id, $status)
    {
        $allowedStatuses = ['En attente de confirmation', 'Confirmée', 'Annulée', 'Terminée'];

        if (!in_array($status, $allowedStatuses)) {
            throw new \InvalidArgumentException("Statut invalide.");
        }
        return $this->reservationRepository->updateStatus($id, $status);

    }

}

<?php
namespace App\Http\Controllers;

use App\Http\Requests\ReservationResquest;
use App\Http\Requests\reservationUpdateRequest;
use App\Http\Requests\statusRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        return $this->reservationService->getAll();
    }

    public function show($id)
    {
        return $this->reservationService->getById($id);
    }

    public function store(ReservationResquest $request)
    {
        return $this->reservationService->create($request->validated());
    }

    public function update(reservationUpdateRequest $request, $id)
    {
        return $this->reservationService->update($id, $request->validated());
    }

    public function destroy($id)
    {
        return $this->reservationService->delete($id);
    }

    public function reservationUser($id)
    {
        return $this->reservationService->reservation($id);
    }

    public function updateStatus(statusRequest $request, $id)
    {
        $request->validated();
        $reservation = $this->reservationService->changeStatus($id, $request->status);

        return response()->json([
            'message' => 'Statut mis à jour avec succès.',
            'data' => $reservation,
        ]);
    }
}

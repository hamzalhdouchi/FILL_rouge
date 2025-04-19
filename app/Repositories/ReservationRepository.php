<?php 
namespace App\Repositories;

use App\Models\Reservation;
use App\RepositoryInterfaces\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all()
    {
        return Reservation::all();
    }

    public function find($id)
    {
        return Reservation::findOrFail($id);
    }

    public function create($data)
    {
        return Reservation::create($data);
    }

    public function update($id, $data)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($data);
        return $reservation;
    }

    public function delete($id)
    {
        return Reservation::destroy($id);
    }
}

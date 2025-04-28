<?php 
namespace App\Repositories;

use App\Models\Reservation;
use App\RepositoryInterfaces\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all($id_Restaurant)
    {
        return Reservation::where('restaurant_id', $id_Restaurant)->get();
    }

    public function find()
    {
        $status = 'livraison';
        return Reservation::where('CommandStatus', $status)->get();
    }

    public function UserReservatuion($id)
    {
        $reservations = Reservation::where('user_id', $id)->get();
        return $reservations;
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

    public function delete($id, $id_Restaurant)
    {
        $reservation = Reservation::where('id', $id)->where('restaurant_id', $id_Restaurant)->firstOrFail();
        return $reservation->delete();
    }

    public function findById($id)
    {
        return Reservation::findOrFail($id);
    } 
    public function updateStatus($id, $status)
    {
        $reservation = $this->findById($id);
        $reservation['status'] = $status;
        $reservation->save();
        return $reservation;
    }
}

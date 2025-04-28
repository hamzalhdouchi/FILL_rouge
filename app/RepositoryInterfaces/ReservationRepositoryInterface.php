<?php
namespace App\RepositoryInterfaces;

interface ReservationRepositoryInterface
{
    public function all($id_Restaurant);
    public function find();
    public function create($data);
    public function update($id, $data);
    public function delete($id, $id_Restaurant);
    public function UserReservatuion($id);
    public function updateStatus($id, $status);

}

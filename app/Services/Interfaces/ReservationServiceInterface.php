<?php
namespace App\Services\Interfaces;

interface ReservationServiceInterface
{
    public function getAll($id_Restaurant);
    public function getById();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id, $id_Restaurant);
    public function reservation($id);

    public function changeStatus($id, $status);

}

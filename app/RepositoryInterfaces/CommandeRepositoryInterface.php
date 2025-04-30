<?php

namespace App\RepositoryInterfaces;

interface CommandeRepositoryInterface
{
    public function create(array $data);
    public function getById($id);
    public function getAll($id);
    public function update($id, array $data);
    public function delete($id);
    public function changeStatus($id, $status);
    public function calculateTotal($id);
    public function calculateSubTotal($id);
    public function getCommendById($restaurant_id, $table_id);
    public function getAllByRestaurantId($restaurant_id);
    public function delet($id);
    public function changeAction($id, $data);
    public function assignLivreur($data, $id);

}

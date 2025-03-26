<?php

namespace App\RepositoryInterfaces;

interface CommandeRepositoryInterface
{
    public function create(array $data);
    public function getById($id);
    public function getAll();
    public function update($id, array $data);
    public function delete($id);
    public function changeStatus($id, $status);
    public function calculateTotal($id);
    public function calculateSubTotal($id);
}

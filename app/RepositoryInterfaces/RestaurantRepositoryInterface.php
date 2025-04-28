<?php

namespace App\RepositoryInterfaces;

interface RestaurantRepositoryInterface
{
    public function getAll(); 
    public function getById($id); 
    public function create( $data);
    public function update( $data, $id);
    public function delete($id); 
    public function getReById($id);
    public function getAllAccepted();
}

<?php

namespace App\Services\Interfaces;

interface RestaurantServiceInterface
{
    public function getAllRestaurants();
    public function getRestaurantById($id); 
    public function createRestaurant(array $data); 
    public function updateRestaurant(array $data, $id); 
    public function deleteRestaurant($id); 
}

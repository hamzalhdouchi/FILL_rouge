<?php

namespace App\Services\Interfaces;

interface RestaurantServiceInterface
{
    public function getAllRestaurants();
    public function getRestaurantById($id); 
    public function createRestaurant( $data); 
    public function updateRestaurant( $data, $id); 
    public function deleteRestaurant($id); 
    public function acceptRestaurant($id);
    public function rejectRestaurant($id);
    public function getAllRes();
}

<?php

namespace App\Repositories;

use App\Models\Restaurant;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getAll()
    {
        return Restaurant::all(); 
    }

    public function getById($id)
    {
        return Restaurant::findOrFail($id); 
    }

    // Créer un restaurant
    public function create(array $data)
    {
        return Restaurant::create($data); 
    }

    public function update(array $data, $id)
    {
        $restaurant = Restaurant::findOrFail($id); 
        $restaurant->update($data);
        return $restaurant; 
    }

    public function delete($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete(); 
        return $restaurant;
    }
}

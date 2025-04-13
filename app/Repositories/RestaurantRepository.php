<?php

namespace App\Repositories;

use App\Models\Restaurant;
use App\Models\User;
use App\RepositoryInterfaces\RestaurantRepositoryInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getAll()
    {
        return Restaurant::all(); 
    }

    public function getById($id)
    {
        return Restaurant::with('user')->findOrFail($id); 
    }

    public function create( $data)
    {
        if (isset($data['image'])) {
            $path = $data['image']->store('restaurants', 'public');
            $data['image'] = str_replace('public/', '', $path);
        }
        return Restaurant::create($data);
    }

    public function update( $data, $id)
    {
        $restaurant = Restaurant::findOrFail($id); 
        if (!$restaurant) {
            return response()->json(['message' => 'restaurant not found'],404);
        }
        $reponse = $restaurant->update($data);
        return $reponse;
    }

    public function delete($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete(); 
        return $restaurant;
    }
}

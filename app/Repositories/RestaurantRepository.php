<?php

namespace App\Repositories;

use App\Models\Restaurant;
use App\Models\User;
use App\RepositoryInterfaces\RestaurantRepositoryInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getAll()
    {
        
        return Restaurant::paginate(9); 
    }
    public function getAllAccepted()
    {
        $statut = "accepted";
        return Restaurant::where('status', $statut)->paginate(9); 
    }

    public function getById($id)
    {
        return Restaurant::where('user_created_id',$id)->first(); 
    }

    public function getReById($id)
    {
        $restaurant = Restaurant::with('user')->find( $id);
        return $restaurant;
    }

    public function create( $data)
    {
        if (isset($data['image'])) {
            $path = $data['image']->store('restaurants', 'public');
            $data['image'] = str_replace('public/', '', $path);
        }
        try {
            $user = User::create([
                'nom_utilisateur' => $data['nom_utilisateur'],
                'prenom' => $data['prenom'],
                'telephone' => $data['telephone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role_id' => 2,
                ''
            ]);
            $data['user_created_id'] = $user->id;
            $restrants = Restaurant::create($data);
            $Restaurant_id = $restrants->id;
            $menu = $restrants->menu()->create([
                'restaurant_id' => $Restaurant_id,
                'name_Menu' => $data['name_Menu'],
            ]);
        }
        catch (err) {
            return response()->json(['message' => 'Error creating restaurant'], 500);
        }
        return $menu;
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

<?php

namespace App\Services;

use App\Notifications\RestaurantStatusNotification;
use App\RepositoryInterfaces\RestaurantRepositoryInterface;
use App\Services\Interfaces\RestaurantServiceInterface;

class RestaurantService implements RestaurantServiceInterface
{
    protected $restaurantRepository;

    public function __construct(RestaurantRepositoryInterface $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function getAllRestaurants()
    {
        return $this->restaurantRepository->getAll();
    }

    public function getRestaurantById($id)
    {
        return $this->restaurantRepository->getById($id);
    }

    public function createRestaurant( $data)
    {
        return $this->restaurantRepository->create($data);
    }

    public function updateRestaurant( $data, $id)
    {
        return $this->restaurantRepository->update($data, $id);
    }

    public function deleteRestaurant($id)
    {
        $restaurant = $this->restaurantRepository->delete($id);
        return response()->json(['message' => 'the supprition is successfuly','Restaurant' => $restaurant],200);
    }

    public function acceptRestaurant($id)
    {
        $restaurant = $this->restaurantRepository->getById($id);
      
        $restaurant->status = 'accepted';
        $restaurant->save();
        if ($restaurant->user) {
            $restaurant->user->notify(new RestaurantStatusNotification($restaurant, 'accepté'));
        }

        return $restaurant;
    }

    public function rejectRestaurant($id)
    {
        $restaurant = $this->restaurantRepository->getById($id);
        $restaurant->status = 'rejected';
        $restaurant->save();

        if ($restaurant->user) {
            $restaurant->user->notify(new RestaurantStatusNotification($restaurant, 'refusé'));


        }

        return $restaurant;
    }
}

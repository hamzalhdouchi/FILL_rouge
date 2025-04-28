<?php

namespace App\Services;

use App\Notifications\RestaurantStatusNotification;
use App\RepositoryInterfaces\RestaurantRepositoryInterface;
use App\Services\Interfaces\RestaurantServiceInterface;
use Illuminate\Http\JsonResponse;

class RestaurantService implements RestaurantServiceInterface
{
    protected RestaurantRepositoryInterface $restaurantRepository;

    public function __construct(RestaurantRepositoryInterface $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function getAllRestaurants()
    {
        $restaurants = $this->restaurantRepository->getAll();

        if (!$restaurants || $restaurants->isEmpty()) {
            return response()->json(['message' => 'Aucun restaurant trouvé.'], 404);
        }

        return response()->json(['message' => 'Liste des restaurants récupérée avec succès.','data' => $restaurants], 200);
    }

    public function getAllRes()
    {
        $restaurants = $this->restaurantRepository->getAllAccepted();

        if (!$restaurants || $restaurants->isEmpty()) {
            return response()->json(['message' => 'Aucun restaurant trouvé.'], 404);
        }

        return response()->json(['message' => 'Liste des restaurants récupérée avec succès.','data' => $restaurants], 200);
    }

    public function getRestaurantById($id)
    {
        $restaurant = $this->restaurantRepository->getById($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant introuvable.'], 404);
        }

        return response()->json(['message' => 'Restaurant récupéré avec succès.','data' => $restaurant], 200);
    }

    public function createRestaurant($data)
    {
        $createRestaurant = $this->restaurantRepository->create($data);

        if (!$createRestaurant) {
            return response()->json(['message' => 'Échec de la création du restaurant. Veuillez réessayer.'], 500);
        }

        return response()->json(['message' => 'Le restaurant a été créé avec succès.'], 201);
    }

    public function updateRestaurant($data, $id)
    {
        $updateRestaurant = $this->restaurantRepository->update($data, $id);

        if (!$updateRestaurant) {
            return response()->json(['message' => 'Échec de la mise à jour du restaurant. Veuillez vérifier les informations fournies.'], 403);
        }

        return response()->json(['message' => 'Le restaurant a été mis à jour avec succès.'], 200);
    }

    public function deleteRestaurant($id)
    {
        $restaurant = $this->restaurantRepository->delete($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Échec de la suppression du restaurant.'], 404);
        }

        return response()->json(['message' => 'Le restaurant a été supprimé avec succès.'], 200);
    }

    public function acceptRestaurant($id)
    {
        $restaurant = $this->restaurantRepository->getReById($id);

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant introuvable.'], 404);
        }

        $restaurant->status = 'accepted';
        $restaurant->save();
        if ($restaurant->user) {
            $restaurant->user->notify(new RestaurantStatusNotification($restaurant, 'accepté'));
        }

        return response()->json(['message' => 'Le restaurant a été accepté avec succès.','data' => $restaurant], 200);
    }

    public function rejectRestaurant($id)
    {
        $restaurant = $this->restaurantRepository->getReById($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant introuvable.'], 404);
        }

        $restaurant->status = 'rejected';
        $restaurant->save();
        if ($restaurant->user) {
            $restaurant->user->notify(new RestaurantStatusNotification($restaurant, 'refusé'));
        }

        return response()->json(['message' => 'Le restaurant a été refusé.','data' => $restaurant], 200);
    }
}

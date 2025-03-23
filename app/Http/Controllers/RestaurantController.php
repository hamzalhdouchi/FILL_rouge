<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResaurantResquest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Services\Interfaces\RestaurantServiceInterface;

class RestaurantController extends Controller
{
        protected $restaurantService;
    
        public function __construct(RestaurantServiceInterface $restaurantService)
        {
            $this->restaurantService = $restaurantService;
        }
    
        public function index()
        {
            return response()->json($this->restaurantService->getAllRestaurants());
        }
    
        public function show($id)
        {
            return response()->json($this->restaurantService->getRestaurantById($id));
        }
    
        public function store(ResaurantResquest $request)
        {
            $request->validated();
            $restaurant = $this->restaurantService->createRestaurant($request->all());
            return response()->json($restaurant, 201);
        }
    
        public function update(RestaurantUpdateRequest $request, $id)
        {
            $request->validated();
            $restaurant = $this->restaurantService->updateRestaurant($id, $request->all());
            return response()->json($restaurant);
        }
    
        public function destroy($id)
        {
            $this->restaurantService->deleteRestaurant($id);
            return response()->json(['message' => 'Suppression réussie'], 204);
        }

        public function accept($id)
        {
            $restaurant = $this->restaurantService->acceptRestaurant($id);
            return response()->json(['message' => 'Restaurant accepté avec succès', 'restaurant' => $restaurant]);
        }
    
        public function reject($id)
        {
            $restaurant = $this->restaurantService->rejectRestaurant($id);
            return response()->json(['message' => 'Restaurant refusé avec succès', 'restaurant' => $restaurant]);
        }
    }
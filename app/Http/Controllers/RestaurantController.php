<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResaurantResquest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Models\Restaurant;
use Auth;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return response()->json($restaurants);
    }

    public function show($id)
    {
        $restaurant = Auth::user()->restaurants()->findOrFail($id);
        return response()->json($restaurant);
    }

    public function store(ResaurantResquest $request)
    {
        $request->validated($request);

        $restaurant = Restaurant::create($request->all());
        return response()->json($restaurant, 201);
    }

    public function update(RestaurantUpdateRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $request->validated($request);

        $restaurant->update($request->all());
        return response()->json($restaurant);
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return response()->json('suppreme is successfully', 204);
    }
}
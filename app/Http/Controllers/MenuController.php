<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuResquest;
use App\Http\Requests\MenuUpdateRequest;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idRestaurant)
    {
        $restaurant = Restaurant::find($idRestaurant);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant non trouvé'], 404);
        }

        $menus = $restaurant->menus;
        return response()->json($menus);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuResquest $request, $idRestaurant)
    {
        $restaurant = Restaurant::find($idRestaurant);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant non trouvé'], 404);
        }

        $request->validated();

        $menu = $restaurant->menus()->create([
            'name_Menu' => $request->nameMenu,
            'isActif' => $request->isActif ?? true,
        ]);

        return response()->json($menu, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($idRestaurant, $idMenu)
    {
        $menu = Menu::where('id_Restaurant', $idRestaurant)->find($idMenu);
        if (!$menu) {
            return response()->json(['message' => 'Menu non trouvé'], 404);
        }
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuUpdateRequest $request, $idRestaurant, $idMenu)
    {
        $menu = Menu::where('idRestaurant', $idRestaurant)->find($idMenu);
        if (!$menu) {
            return response()->json(['message' => 'Menu non trouvé'], 404);
        }

        $request->validated();

        $menu->update($request->only(['nameMenu', 'isActif']));
        return response()->json($menu);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idRestaurant, $idMenu)
    {
        $menu = Menu::where('idRestaurant', $idRestaurant)->find($idMenu);
        if (!$menu) {
            return response()->json(['message' => 'Menu non trouvé'], 404);
        }

        $menu->delete();
        return response()->json(['message' => 'Menu supprimé']);
    }
}

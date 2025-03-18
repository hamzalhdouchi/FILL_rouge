<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuResquest;
use App\Http\Requests\MenuUpdateRequest;
use App\Services\Interfaces\MenuServiceInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuServiceInterface $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index($idRestaurant)
    {
        $menus = $this->menuService->getAllMenus($idRestaurant);
        return $menus ? response()->json($menus) : response()->json(['message' => 'Restaurant non trouvé'], 404);
    }

    public function show($idRestaurant, $idMenu)
    {
        $menu = $this->menuService->getMenuById($idRestaurant, $idMenu);
        return $menu ? response()->json($menu) : response()->json(['message' => 'Menu non trouvé'], 404);
    }

    public function store(MenuResquest $request, $idRestaurant)
    {
        $menu = $this->menuService->createMenu($idRestaurant, $request->validated());
        return $menu ? response()->json($menu, 201) : response()->json(['message' => 'Restaurant non trouvé'], 404);
    }

    public function update(MenuUpdateRequest $request, $idRestaurant, $idMenu)
    {
        $menu = $this->menuService->updateMenu($idRestaurant, $idMenu, $request->validated());
        return $menu ? response()->json($menu) : response()->json(['message' => 'Menu non trouvé'], 404);
    }

    public function destroy($idRestaurant, $idMenu)
    {
        return $this->menuService->deleteMenu($idRestaurant, $idMenu)
            ? response()->json(['message' => 'Menu supprimé'])
            : response()->json(['message' => 'Menu non trouvé'], 404);
    }
}

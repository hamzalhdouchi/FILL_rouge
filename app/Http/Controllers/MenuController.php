<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuResquest;
use App\Http\Requests\MenuUpdateRequest;
use App\Services\Interfaces\MenuServiceInterface;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    protected MenuServiceInterface $menuService;

    public function __construct(MenuServiceInterface $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index($idRestaurant)
    {
        $menus = $this->menuService->getAllMenus($idRestaurant);
        return $menus;
    }

    public function show($idRestaurant, $idMenu)
    {
        $menu = $this->menuService->getMenuById($idRestaurant, $idMenu);
        return $menu;
    }

    public function store(MenuResquest $request, $idRestaurant)
    {
        $menuStore = $this->menuService->createMenu($idRestaurant, $request);
        return $menuStore;
    }

    public function update(MenuUpdateRequest $request, $idRestaurant, $idMenu)
    {
        $menuUpdate = $this->menuService->updateMenu($idRestaurant, $idMenu, $request);
        return $menuUpdate;
    }

    public function destroy($idRestaurant, $idMenu)
    {
        $menuDestroy = $this->menuService->deleteMenu($idRestaurant, $idMenu);
        return $menuDestroy;
    }
}

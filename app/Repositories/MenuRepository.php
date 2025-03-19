<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Restaurant;
use App\RepositoryInterfaces\MenuRepositoryInterface;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAllMenus($restaurantId)
    {
        $restaurant = Restaurant::find($restaurantId);
        return $restaurant ? $restaurant->menus : null;
    }

    public function getMenuById($restaurantId, $menuId)
    {
        return Menu::where('idRestaurant', $restaurantId)->find($menuId);
    }

    public function createMenu($restaurantId,  $data)
    {
        $restaurant = Restaurant::find($restaurantId);
        return $restaurant ? $restaurant->menus()->create($data) : null;
    }

    public function updateMenu($restaurantId, $menuId,  $data)
    {
        $menu = $this->getMenuById($restaurantId, $menuId);
        return $menu ? tap($menu)->update($data) : null;
    }

    public function deleteMenu($restaurantId, $menuId)
    {
        $menu = $this->getMenuById($restaurantId, $menuId);
        return $menu ? $menu->delete() : false;
    }
}

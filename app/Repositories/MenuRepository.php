<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\Restaurant;
use App\RepositoryInterfaces\MenuRepositoryInterface;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAllMenus($restaurantId)
    {
        
        $restaurant = Restaurant::with('Menu.plate.categorie')->find($restaurantId);

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant non trouvé'], 404);
        }
    
        return $restaurant;
    }

    public function getMenuById($restaurantId, $menuId)
    {
        $menu =  Menu::where('restaurant_id', $restaurantId)->find($menuId);
        return $menu;
    }

    public function createMenu($restaurantId,  $data)
    {
        $restaurant = Restaurant::find($restaurantId);
        if (!$restaurant) {
            return null;
        }

        $menuCreate = $restaurant->menu()->create($data);
        return $menuCreate;
    }

    public function updateMenu($restaurantId, $menuId,  $data)
    {
        $menu = $this->getMenuById($restaurantId, $menuId);
        if (!$menu) {
            return null;
        }
        $menuUpdate = tap($menu)->update($data); 
        return $menuUpdate;
    }

    public function deleteMenu($restaurantId, $menuId)
    {
        $menu = $this->getMenuById($restaurantId, $menuId);
        if ($menu) {
            return false;
        }
        $deleteMenu = $menu->delete();
        return $deleteMenu;
    }
}

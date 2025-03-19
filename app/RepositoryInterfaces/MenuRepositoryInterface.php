<?php

namespace App\RepositoryInterfaces;

use App\Models\Menu;

interface MenuRepositoryInterface
{
    public function getAllMenus($restaurantId);
    public function getMenuById($restaurantId, $menuId);
    public function createMenu($restaurantId,  $data);
    public function updateMenu($restaurantId, $menuId,  $data);
    public function deleteMenu($restaurantId, $menuId);
}

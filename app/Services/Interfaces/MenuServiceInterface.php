<?php

namespace App\Services\Interfaces;

interface MenuServiceInterface
{
    public function getAllMenus($restaurantId);
    public function getMenuById($restaurantId, $menuId);
    public function createMenu($restaurantId,  $data);
    public function updateMenu($restaurantId, $menuId,  $data);
    public function deleteMenu($restaurantId, $menuId);
}

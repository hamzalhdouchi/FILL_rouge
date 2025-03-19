<?php

namespace App\Services;

use App\RepositoryInterfaces\MenuRepositoryInterface;
use App\Services\Interfaces\MenuServiceInterface;

class MenuService implements MenuServiceInterface
{
    protected $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function getAllMenus($restaurantId)
    {
        return $this->menuRepository->getAllMenus($restaurantId);
    }

    public function getMenuById($restaurantId, $menuId)
    {
        return $this->menuRepository->getMenuById($restaurantId, $menuId);
    }

    public function createMenu($restaurantId,  $data)
    {
        return $this->menuRepository->createMenu($restaurantId, $data);
    }

    public function updateMenu($restaurantId, $menuId,  $data)
    {
        return $this->menuRepository->updateMenu($restaurantId, $menuId, $data);
    }

    public function deleteMenu($restaurantId, $menuId)
    {
        return $this->menuRepository->deleteMenu($restaurantId, $menuId);
    }
}

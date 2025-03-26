<?php

namespace App\Services;

use App\RepositoryInterfaces\MenuRepositoryInterface;
use App\Services\Interfaces\MenuServiceInterface;
use Illuminate\Http\JsonResponse;

class MenuService implements MenuServiceInterface
{
    protected MenuRepositoryInterface $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function getAllMenus($restaurantId)
    {
        $menus = $this->menuRepository->getAllMenus($restaurantId);

        if (!$menus || empty($menus)) {
            return response()->json(['message' => 'Aucun menu trouvé pour ce restaurant'], 404);
        }

        return response()->json([
            'message' => 'Menus récupérés avec succès',
            'data' => $menus
        ]);
    }

    public function getMenuById($restaurantId, $menuId)
    {
        $menu = $this->menuRepository->getMenuById($restaurantId, $menuId);

        if (!$menu) {
            return response()->json(['message' => 'Menu non trouvé'], 404);
        }

        return response()->json([
            'message' => 'Menu récupéré avec succès',
            'data' => $menu
        ]);
    }

    public function createMenu($restaurantId,$data)
    {
        $menu = $this->menuRepository->createMenu($restaurantId, $data);

        if (!$menu) {
            return response()->json(['message' => 'Échec de la création du menu ou restaurant non trouvé'], 400);
        }

        return response()->json([
            'message' => 'Menu créé avec succès',
            'data' => $menu
        ], 201);
    }

    public function updateMenu($restaurantId, $menuId,  $data)
    {
        $menu = $this->menuRepository->updateMenu($restaurantId, $menuId, $data);

        if (!$menu) {
            return response()->json(['message' => 'Menu non trouvé ou mise à jour impossible'], 404);
        }

        return response()->json([
            'message' => 'Menu mis à jour avec succès',
            'data' => $menu
        ]);
    }

    public function deleteMenu($restaurantId, $menuId): JsonResponse
    {
        $deleted = $this->menuRepository->deleteMenu($restaurantId, $menuId);

        if (!$deleted) {
            return response()->json(['message' => 'Menu non trouvé ou suppression impossible'], 404);
        }

        return response()->json([
            'message' => 'Menu supprimé avec succès'
        ]);
    }
}

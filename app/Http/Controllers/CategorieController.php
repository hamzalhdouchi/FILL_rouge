<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieResquest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Models\Categorie;
use App\Services\Interfaces\CategorieServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategorieController extends Controller
{
    protected $categorieService;

    public function __construct(CategorieServiceInterface $categorieService)
    {
        $this->categorieService = $categorieService;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categorieService->getAllCategories();
        return response()->json($categories);
    }

    public function store(CategorieResquest $request): JsonResponse
    {
        $validated = $request->validated();
        $category = $this->categorieService->createCategory($validated);
        return response()->json($category, 201);
    }

    public function show($id): JsonResponse
    {
        $category = $this->categorieService->getCategoryById($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }
        return response()->json($category);
    }

    public function update(CategorieUpdateRequest $request, Categorie $category): JsonResponse
    {
        $validated = $request->validated();
        $this->categorieService->updateCategory($category, $validated);
        return response()->json($category);
    }

    public function destroy(Categorie $category): JsonResponse
    {
        $this->categorieService->deleteCategory($category);
        return response()->json(['message' => 'Catégorie supprimée'], 204);
    }
}

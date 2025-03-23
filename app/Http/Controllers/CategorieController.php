<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieResquest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Models\Categorie;
use App\Services\Interfaces\CategorieServiceInterface;

class CategorieController extends Controller
{
    protected $categorieService;

    public function __construct(CategorieServiceInterface $categorieService)
    {
        $this->categorieService = $categorieService;
    }

    public function index()
    {
        $categories = $this->categorieService->getAllCategories();
        return response()->json($categories);
    }

    public function store(CategorieResquest $request)
    {
        $validated = $request->validated();
        $category = $this->categorieService->createCategory($validated);
        
        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'category' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = $this->categorieService->getCategoryById($id);
        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }
        return response()->json($category);
    }

    public function update(CategorieUpdateRequest $request, Categorie $category)
    {
        $validated = $request->validated();
        $this->categorieService->updateCategory($category, $validated);
        
        return response()->json([
            'message' => 'Catégorie mise à jour avec succès',
            'category' => $category
        ]);
    }

    public function destroy(Categorie $category)
    {
        $this->categorieService->deleteCategory($category);
        
        return response()->json([
            'message' => 'Catégorie supprimée avec succès'
        ], 200);
    }
}

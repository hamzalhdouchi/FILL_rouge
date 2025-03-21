<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('/profile/{id}', [UserController::class, 'showProfile']);
    Route::post('/User/store', [UserController::class, 'store']);
    Route::delete('/User/{id}', [UserController::class, 'destroy']);
    Route::put('/User/{id}/change-status', [UserController::class, 'changeStatus']);
    Route::put('/User/{id}/update-profile', [UserController::class, 'updateProfile']);

    // Route::post('/forgot-password', [UserController::class, 'sendResetLink']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);

    Route::prefix('restaurants/{restaurantId}/menus')->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::get('{menuId}', [MenuController::class, 'show']);
        Route::post('/', [MenuController::class, 'store']);
        Route::put('{menuId}', [MenuController::class, 'update']);
        Route::delete('{menuId}', [MenuController::class, 'destroy']);
    });

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);

    Route::apiResource('categories', CategorieController::class);

    Route::prefix('categories')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [CategorieController::class, 'index']);
        Route::post('/', [CategorieController::class, 'store']);
        Route::get('/{id}', [CategorieController::class, 'show']);
        Route::put('/{category}', [CategorieController::class, 'update']);
        Route::delete('/{category}', [CategorieController::class, 'destroy']);
    });

    Route::prefix('ingredients')->middleware('auth:sanctum')->group(function ()  {
        Route::post('/', [IngredientController::class, 'store']);
        Route::get('/', [IngredientController::class, 'index']);
        Route::get('/{id}', [IngredientController::class, 'verifierDisponibilite']);
        Route::put('/{id}', [IngredientController::class, 'update']);
        Route::delete('/{id}', [IngredientController::class, 'destroy']);
        Route::put('/{id}/stock', [IngredientController::class, 'mettreAJourStock']);
    });

    Route::prefix('plats')->middleware('auth:sanctum')->group(function ()  {
    Route::post('/', [PlatController::class, 'store']);
    Route::get('/', [PlatController::class, 'index']);
    Route::put(':/{id}', [PlatController::class, 'update']);
    Route::delete('/{id}', [PlatController::class, 'destroy']);
    Route::put('/{id}/disponibilite', [PlatController::class, 'changerDisponibilite']);
    });



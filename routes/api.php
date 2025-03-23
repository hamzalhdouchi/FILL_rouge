<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
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
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

    Route::middleware('auth:sanctum')->get('/user', function () {
        Route::get('/profile/{id}', [UserController::class, 'showProfile']);
        Route::delete('/User/{id}', [UserController::class, 'destroy']);
        Route::put('/User/{id}/change-status', [UserController::class, 'changeStatus']);
        Route::put('/User/{id}/update-profile', [UserController::class, 'updateProfile']);
    });

    // Route::post('/forgot-password', [UserController::class, 'sendResetLink']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);

    Route::prefix('restaurants/{restaurantId}/menus')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [MenuController::class, 'index']);
        Route::get('{menuId}', [MenuController::class, 'show']);
        Route::post('/', [MenuController::class, 'store']);
        Route::put('{menuId}', [MenuController::class, 'update']);
        Route::delete('{menuId}', [MenuController::class, 'destroy']);
    });
    Route::prefix('restaurants')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('/{id}', [RestaurantController::class, 'show']);
        Route::post('/', [RestaurantController::class, 'store']);
        Route::put('/{id}', [RestaurantController::class, 'update']);
        Route::delete('/{id}', [RestaurantController::class, 'destroy']);
    });
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

    Route::prefix('paiement')->group(function () {
        Route::post('/pay', [PaiementController::class, 'pay']);
        Route::get('/success', [PaiementController::class, 'success']);
        Route::get('/error', [PaiementController::class, 'error']);
        Route::get('/all', [PaiementController::class, 'readAllPayments']);
    });



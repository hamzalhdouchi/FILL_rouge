<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CharacterController;
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

    Route::post('/forgot-password', [UserController::class, 'sendResetLink']);
    Route::post('/reset-password', [UserController::class, 'resetPassword']);
    Route::prefix('menus/{idRestaurant}')->group(function () {
    Route::get('/', [Menu::class, 'index']);
    Route::get('/{idMenu}', [Menu::class, 'show']);
    Route::post('/', [Menu::class, 'store']);
    Route::put('/{idMenu}', [Menu::class, 'update']);
    Route::delete('/{idMenu}', [Menu::class, 'destroy']);
});
    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);

    Route::apiResource('categories', CategorieController::class);



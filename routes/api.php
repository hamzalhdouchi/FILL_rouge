<?php

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
Route::middleware('auth:sanctum')->get('/profile', [User::class, 'showProfile']);

Route::delete('/User/{id}', [User::class, 'destroy']);
Route::put('/User/{id}/change-status', [User::class, 'changeStatus']);
Route::put('/User/{id}/update-profile', [User::class, 'updateProfile']);

Route::post('/forgot-password', [User::class, 'sendResetLink']);
Route::post('/reset-password', [User::class, 'resetPassword']);
Route::prefix('restaurants/{idRestaurant}/menus')->group(function () {
    Route::get('/', [Menu::class, 'index']);
    Route::get('/{idMenu}', [Menu::class, 'show']);
    Route::post('/', [Menu::class, 'store']);
    Route::put('/{idMenu}', [Menu::class, 'update']);
    Route::delete('/{idMenu}', [Menu::class, 'destroy']);
});
<?php

namespace App\Providers;

use App\Repositories\CategorieRepository;
use App\Repositories\IngredientRepository;
use App\RepositoryInterfaces\CategorieRepositoryInterface;
use App\RepositoryInterfaces\IngredientRepositoryInterface;
use App\RepositoryInterfaces\MenuRepositoryInterface;
use App\Repositories\MenuRepository;
use App\Repositories\RestaurantRepository;
use App\Repositories\RestaurantRepositoryInterface;
use App\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\CategorieService;
use App\Services\Interfaces\CategorieServiceInterface;
use App\Services\Interfaces\MenuServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\MenuService;
use App\Services\RestaurantService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(RestaurantServiceInterface::class, RestaurantService::class);
        $this->app->bind(RestaurantRepositoryInterface::class, RestaurantRepository::class);    

        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(MenuServiceInterface::class, MenuService::class);

        $this->app->bind(CategorieRepositoryInterface::class, CategorieRepository::class);
        $this->app->bind(CategorieServiceInterface::class, CategorieService::class);

        $this->app->bind(Ing::class, IngredientRepository::class);
        $this->app->bind(IngredientRepositoryInterface::class, IngredientRepository::class);
        }

    public function boot(): void
    {
        //
    }
}

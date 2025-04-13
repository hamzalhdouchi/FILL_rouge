<?php

namespace App\Providers;

use App\Repositories\CategorieRepository;
use App\Repositories\CommandeRepository;
use App\Repositories\IngredientRepository;
use App\Repositories\Interfaces\LivreurRepositoryInterface;
use App\Repositories\LivreurRepository;
use App\Repositories\PaiementRepository;
use App\Repositories\PlatRepository;
use App\Repositories\RestaurantRepository;
use App\RepositoryInterfaces\CategorieRepositoryInterface;
use App\RepositoryInterfaces\CommandeRepositoryInterface;
use App\RepositoryInterfaces\IngredientRepositoryInterface;
use App\RepositoryInterfaces\MenuRepositoryInterface;
use App\Repositories\MenuRepository;
use App\RepositoryInterfaces\RestaurantRepositoryInterface;
use App\RepositoryInterfaces\PaiementRepositoryInterface;
use App\RepositoryInterfaces\PlatRepositoryInterface;
use App\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\CategorieService;
use App\Services\CommandeService;
use App\Services\IngredientService;
use App\Services\Interfaces\CategorieServiceInterface;
use App\Services\Interfaces\CommandeServiceInterface;
use App\Services\Interfaces\IngredientServiceInterface;
use App\Services\Interfaces\LivreurServiceInterface;
use App\Services\Interfaces\MenuServiceInterface;
use App\Services\Interfaces\PaiementServiceInterface;
use App\Services\Interfaces\PlatServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\LivreurService;
use App\Services\MenuService;
use App\Services\PaiementService;
use App\Services\PlatService;
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

        $this->app->bind(IngredientRepositoryInterface::class, IngredientRepository::class);
        $this->app->bind(IngredientServiceInterface::class, IngredientService::class);

        $this->app->bind(PlatRepositoryInterface::class, PlatRepository::class);
        $this->app->bind(PlatServiceInterface::class, PlatService::class);

        $this->app->bind(PaiementRepositoryInterface::class, PaiementRepository::class);
        $this->app->bind(PaiementServiceInterface::class, PaiementService::class);

        $this->app->bind(CommandeRepositoryInterface::class,CommandeRepository::class);
        $this->app->bind(CommandeServiceInterface::class,CommandeService::class);

        $this->app->bind(LivreurRepositoryInterface::class,LivreurRepository::class);
        $this->app->bind(LivreurServiceInterface::class,LivreurService::class);
        }

    public function boot(): void
    {
        //
    }
}

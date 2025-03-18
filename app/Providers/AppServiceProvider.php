<?php

namespace App\Providers;

use App\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\ServiceInterfaces\UserServiceInterface;
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
        
         $this->app->bind(\App\Services\Interfaces\UserServiceInterface::class, UserService::class);

        // $this->app->bind(
        //     CharacterRepositor::class,
        //     EloquentCharacterRepository::class,
        // );
        

        }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repositories\User\UserEloquent;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoriesServiceProvider::class);
        $this->app->bind(UserRepository::class, UserEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

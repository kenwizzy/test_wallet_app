<?php

namespace App\Providers;

use App\Repositories\Wallet\WalletEloquent;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Wallet\WalletRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WalletRepository::class, WalletEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

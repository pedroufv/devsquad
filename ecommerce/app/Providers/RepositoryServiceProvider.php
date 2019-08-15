<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Interfaces\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ProductRepository::class, \App\Repositories\ProductRepositoryEloquent::class);
        //:end-bindings:
    }
}

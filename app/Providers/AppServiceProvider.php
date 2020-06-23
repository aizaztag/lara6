<?php

namespace App\Providers;

use App\Contract\ProductContract;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;


class AppServiceProvider extends ServiceProvider
{

    protected $repositories = [
        ProductContract::class => ProductRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing', 'staging')) {
            $this->app->register(DuskServiceProvider::class);
        }

        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
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

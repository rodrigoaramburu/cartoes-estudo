<?php

namespace App\Core\Providers;

use App\Core\Components\App;
use Domain\Deck\Repositories\DeckRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\DeckRepositoryEloquent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DeckRepositoryInterface::class, DeckRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('app', App::class);
    }
}

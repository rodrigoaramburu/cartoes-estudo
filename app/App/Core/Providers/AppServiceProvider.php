<?php

namespace App\Core\Providers;

use App\Core\Components\App;
use App\Core\Components\Editor;
use App\Core\Components\Flash;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Domain\Deck\Repositories\DeckRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\CardRepositoryEloquent;
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
        $this->app->bind(CardRepositoryInterface::class, CardRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('app', App::class);
        Blade::component('flash', Flash::class);
        Blade::component('editor', Editor::class);
    }
}

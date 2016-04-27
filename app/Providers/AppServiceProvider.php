<?php

namespace App\Providers;

use App\Models\Game;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['request']->server->set('HTTPS', config('app.ssl'));
        view()->composer('*', function ($view) {
            $games = Game::all();
            $view->with('auth', auth()->user())
                ->with('routeName', request()->route() ? request()->route()->getName() : null)->with('games',$games);
            
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

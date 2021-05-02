<?php

namespace App\Providers;
use App\Models\Departement;
use App\Models\User;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['tasks.fields'], function ($view) {
            $userItems = User::pluck('name','id')->toArray();
            $view->with('userItems', $userItems);
        });
        View::composer(['projects.fields'], function ($view) {
            $userItems = User::pluck('id','name')->toArray();
            $view->with('userItems', $userItems);
        });
        View::composer(['services.fields'], function ($view) {
            $departementItems = Departement::pluck('name','id')->toArray();
            $view->with('departementItems', $departementItems);
        });
        View::composer(['services.fields'], function ($view) {
            $userItems = User::pluck('name','id')->toArray();
            $view->with('userItems', $userItems);
        });
        View::composer(['departements.fields'], function ($view) {
            $userItems = User::pluck('name','id')->toArray();
            $view->with('userItems', $userItems);
        });
        //
    }
}
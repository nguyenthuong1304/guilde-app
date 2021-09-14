<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Configuration;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        View::composer(['layouts.nav'], function ($view) {
            $categories = Category::select('id', 'name')
                ->with('children:id,name,parent_id')
                ->whereNull('parent_id')
                ->orderBy('id')
                ->get();

            $view->with('categories', $categories);
        });

        View::composer(['layouts.app'], function ($view) {
            $view->with('config', Configuration::first());
        });
    }
}

<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
        \View::composer('*', function($view) {
            $categories = \Cache::rememberForever('categories', function () {
                return Category::all();
            });
            $taskTypes = \Cache::rememberForever('taskTypes', function () {
                return \DB::table('tasktypes')
                        ->select('id', 'name', 'color')
                        ->get();
            });
            
            $view->with('categories', $categories);
            $view->with('taskTypes', $taskTypes);
        });

        Paginator::useBootstrap();
    }
}

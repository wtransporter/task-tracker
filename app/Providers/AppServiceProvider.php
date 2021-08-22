<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\Priority;
use App\Models\Tasktype;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
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
            $allUsers = \Cache::rememberForever('users', function () {
                return User::all();
            });

            $statuses = \Cache::rememberForever('statuses', function () {
                return Status::all();
            });
            $priorities = \Cache::rememberForever('priorities', function () {
                return Priority::all();
            });

            $allTasktypes = Cache::remember('task-types', 60*5, function() {
                return Tasktype::all();
            });
            
            $view->with('categories', $categories);
            $view->with('taskTypes', $taskTypes);
            $view->with('allUsers', $allUsers);
            $view->with('statuses', $statuses);
            $view->with('priorities', $priorities);
            $view->with('allTasktypes', $allTasktypes);
        });

        \View::composer('components.admin', function($view) {
            $user = auth()->user();

            $counts['notifications'] = $user->unreadNotifications()->count();
            $counts['tasks'] = $user->activeTasks()->count();

            return $view->with('count', $counts);
        });

        Paginator::useBootstrap();
    }
}

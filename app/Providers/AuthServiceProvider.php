<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('project_manage', fn(User $user) => $user->is_admin);
        Gate::define('view_tasks', function($user, $project) {
            return $user->is_admin || $project->members->contains($user);
        });
        Gate::define('edit_task_description', function(User $user) {
            return !! $user->is_admin;
        });
    }
}

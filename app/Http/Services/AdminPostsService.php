<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Project;

class AdminPostsService
{
    public User $user;

    public function handle(User $user)
    {
        if ($user->is_admin) {
            return Project::with('categories')
                ->withCount(['tasks', 'completedTasks'])
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        } else {
            return $user->assignedProjects()
                ->with('categories')->withCount(['tasks', 'completedTasks'])
                ->latest()
                ->paginate(10);
        }
    }
}
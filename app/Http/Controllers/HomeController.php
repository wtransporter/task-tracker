<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $projects = Project::with('categories')
                ->withCount(['tasks', 'completedTasks'])
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        } else {
            $projects = auth()->user()->assignedProjects()
                ->with('categories')->withCount(['tasks', 'completedTasks'])
                ->latest()
                ->paginate(10);
        }

        return view('pages.home', compact('projects'));
    }
    
    /**
     * Show the list of Tasks assignet to a user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tasks()
    {
        return view('pages.user-tasks');
    }
}

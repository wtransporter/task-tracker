<?php

namespace App\Http\Controllers;

use App\Http\Services\AdminPostsService;
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
     * @param AdminPostsService $service
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(AdminPostsService $service)
    {
        $projects = $service->handle(auth()->user());

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

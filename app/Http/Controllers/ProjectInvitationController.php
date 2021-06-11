<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\CreateProjectInvitationRequest;

class ProjectInvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Project $project
     * @param  CreateProjectInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, CreateProjectInvitationRequest $request)
    {
        $project->invite($request->get('users'));

        return redirect()->route('projects.edit', $project)->with('message', 'User added/removed to project.');
    }
}

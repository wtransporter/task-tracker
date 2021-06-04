<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::with('tasks', 'tasks.tasktype')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UpdateProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateProjectRequest $request)
    {
        $project = auth()->user()->projects()
            ->create($request->only(['title', 'content', 'note']));
        $project->categories()->attach($request->categories);

        return redirect()->route('projects.index')->with('message', 'New project created');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $selectedCategories = $project->categories()->pluck('name')->toArray();
        return view('projects.edit', compact('project', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectRequest $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->only('title', 'content', 'note'));
        $project->categories()->sync($request->categories);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->tasks()->count() > 0) {
            return redirect()->back()->withErrors('Project that has tasks cannot be deleted.');
        }

        $project->delete();

        return redirect()->route('projects.index')->with('message', 'Project successfully deleted.');
    }
}

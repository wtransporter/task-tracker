<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $this->authorize('view_tasks', $project);
        
        return view('tasks.index', compact('project'));
    }

    /**
     * Show specified resource
     *
     * @param Project $project
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        $task->load(['user', 'comments', 'comments.user']);

        return view('tasks.show', compact('project', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', $task);
        $task->load(['comments', 'comments.user']);

        return view('tasks.edit', ['project' => $project, 'task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreTaskRequest $request
     * @param  Project $project
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->route('projects.tasks.edit', [$project, $task])->with('task-message', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @param  Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('projects.tasks.create', $project)->with('task-message', 'Task delted');
    }
}

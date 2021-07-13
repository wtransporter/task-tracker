<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  Task $task
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Task $task, Request $request)
    {
        $attributes = $request->validate(['description' => 'required']);

        $task->adjustments()->attach(auth()->id(), $attributes);

        return redirect()->back()->with(['project' => $task->project, 'task' => $task])->with('toast_success', 'You left note');
    }
}

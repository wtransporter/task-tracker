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
        $attributes = array_merge(['user_id' => auth()->id()], $attributes);

        $task->comments()->create($attributes);

        return redirect()->back()->with(['project' => $task->project, 'task' => $task])->with('message', 'You left comment');
    }
}

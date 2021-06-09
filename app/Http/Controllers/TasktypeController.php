<?php

namespace App\Http\Controllers;

use App\Models\Tasktype;
use App\Http\Requests\StoreTasktypeRequest;

class TasktypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tasktypes.index', [
            'tasktypes' => Tasktype::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tasktypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTasktypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTasktypeRequest $request)
    {
        $type = Tasktype::create($request->validated());

        return redirect()->route('tasktypes.create')->with('message', $type->name . ' type created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tasktype $tasktype
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasktype $tasktype)
    {
        return view('admin.tasktypes.edit', compact('tasktype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreTasktypeRequest $request
     * @param  Tasktype $tasktype
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTasktypeRequest $request, Tasktype $tasktype)
    {
        $tasktype->update($request->validated());

        return redirect()->route('tasktypes.index')->with('message', 'Type succesfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tasktype  $tasktype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasktype $tasktype)
    {
        $name = $tasktype->name;
        $tasktype->delete();

        return redirect()->route('tasktypes.index')->with('message', "Type {$name} successfully deleted.");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;
use App\Http\Requests\StorePriorityRequest;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.priorities.index', [
            'priorities' => Priority::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePriorityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriorityRequest $request)
    {
        Priority::create($request->validated());

        return redirect()->route('priorities.index')->with('message', 'Entry successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Priority $priority
     * @return \Illuminate\Http\Response
     */
    public function edit(Priority $priority)
    {
        return view('admin.priorities.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StorePriorityRequest $request
     * @param  Status $priority
     * @return \Illuminate\Http\Response
     */
    public function update(StorePriorityRequest $request, Priority $priority)
    {
        $priority->update($request->validated());

        return redirect()->route('priorities.index')->with('message', 'Status succesfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Status  $priority
     * @return \Illuminate\Http\Response
     */
    public function destroy(Priority $priority)
    {
        $name = $priority->name;
        $priority->delete();

        return redirect()->route('priorities.index')->with('message', "Priority {$name} successfully deleted.");
    }
}

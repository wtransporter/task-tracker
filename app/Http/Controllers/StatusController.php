<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.statuses.index', [
            'statuses' => Status::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusRequest $request)
    {
        Status::create($request->validated());

        return redirect()->route('statuses.create')->with('message', 'Entry successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Status $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('admin.statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreStatusRequest $request
     * @param  Status $status
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStatusRequest $request, Status $status)
    {
        $status->update($request->validated());

        return redirect()->route('statuses.index')->with('message', 'Status succesfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $name = $status->name;
        $status->delete();

        return redirect()->route('statuses.index')->with('message', "Status {$name} successfully deleted.");
    }
}

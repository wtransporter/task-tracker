<?php

namespace App\Http\Controllers;

use App\Models\Tasktype;
use Illuminate\Http\Request;

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

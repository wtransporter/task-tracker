<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TasksTable extends Component
{
    public $project;

    public function render()
    {
        $tasks = $this->project->tasks()->get();

        return view('livewire.tasks-table', compact('tasks'));
    }
}

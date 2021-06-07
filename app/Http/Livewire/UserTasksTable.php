<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UserTasksTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $project;

    public function toggleStatus($id)
    {
        $task = $this->project->tasks()->find($id)->first();
        is_null($task->finished_at) ? $task->finished_at = now() : $task->finished_at = null;
        
        $task->save();
    }

    public function render()
    {
        $tasks = $this->project->tasks()->paginate(10);
        
        return view('livewire.user-tasks-table', compact('tasks'));
    }
}

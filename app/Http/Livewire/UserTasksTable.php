<?php

namespace App\Http\Livewire;

use App\Traits\Toggleable;
use Livewire\Component;
use Livewire\WithPagination;

class UserTasksTable extends Component
{
    use WithPagination, Toggleable;

    protected $paginationTheme = 'bootstrap';
    public $project;
    public $active = true;
    public $search;

    public function toggleStatus($id)
    {
        $task = $this->project->tasks()->find($id)->first();
        is_null($task->finished_at) ? $task->finished_at = now() : $task->finished_at = null;
        
        $task->save();
    }

    public function clearSearch()
    {
        $this->search = null;
    }

    public function render()
    {
        $tasks = $this->project->tasks()
            ->with('tasktype')
            ->where('user_id', auth()->id())
            ->when($this->active, function($query) {
                return $query->whereNull('finished_at');
            })
            ->when($this->search, function ($query) {
                return $query->where('title', 'LIKE', '%'.$this->search.'%');
            })
            ->paginate(10);
        
        return view('livewire.user-tasks-table', compact('tasks'));
    }
}

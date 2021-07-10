<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Traits\Toggleable;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination, Toggleable;

    protected $paginationTheme = 'bootstrap';
    public $project = null;
    public $sort = true;
    public $sortField = '';
    public $active = true;
    public $search;
    public $tasktypes = [];

    protected $listeners = [
        'taskAssigned',
        'taskAdded' => '$refresh'
    ];

    public function taskAssigned($message)
    {
        session()->flash('task-message', $message);
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sort = !$this->sort;
        } else {
            $this->sort = true;
        }

        $this->sortField = $field;
    }

    public function toggleStatus(Task $task)
    {
        is_null($task->finished_at) ? $task->finished_at = now() : $task->finished_at = null;
        
        $task->save();
    }

    public function clearSearch()
    {
        $this->search = null;
    }

    public function clear()
    {
        $this->tasktypes = [];
    }

    public function render()
    {
        if (is_null($this->project)) {
            $tasks = $this->userTasks();
        } else {
            $tasks = $this->tasks();
        }

        return view('livewire.tasks-table', compact('tasks'));
    }

    public function tasks()
    {
        return $this->project->tasks()
            ->with(['project', 'tasktype', 'user', 'status', 'priority'])
            ->when($this->active, function ($query) {
                return $query->whereNull('finished_at');
            })
            ->when($this->search, function ($query) {
                return $query->where('title', 'LIKE', '%'.$this->search.'%');
            })
            ->when($this->sortField, function ($query) {
                return $query->orderBy($this->sortField, $this->sort ? 'asc' : 'desc');
            })
            ->when($this->tasktypes, function($query) {
                return $query->where('tasktype_id', $this->tasktypes);
            })
            ->paginate(10);
    }

    public function userTasks()
    {
        return auth()->user()->tasks()
            ->with('project', 'user', 'tasktype', 'priority', 'status')
            ->when($this->active, function ($query) {
                return $query->whereNull('finished_at');
            })
            ->when($this->search, function ($query) {
                return $query->where('title', 'LIKE', '%'.$this->search.'%');
            })
            ->when($this->sortField, function ($query) {
                return $query->orderBy($this->sortField, $this->sort ? 'asc' : 'desc');
            })
            ->when($this->tasktypes, function($query) {
                return $query->whereIn('tasktype_id', $this->tasktypes);
            })
            ->paginate(10);
    }
}

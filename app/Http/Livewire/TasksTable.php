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

    public function filters()
    {
        return [
            'active' => $this->active,
            'sortField' => $this->sortField,
            'tasktypes' => $this->tasktypes,
            'search' => $this->search,
        ];
    }

    public function tasks()
    {
        return $this->project->tasks()->filter($this->filters())
                ->paginate(10);
    }

    public function userTasks()
    {
        return auth()->user()->tasks()->filter($this->filters())
                ->paginate(10);
    }
}

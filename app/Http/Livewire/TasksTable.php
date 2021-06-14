<?php

namespace App\Http\Livewire;

use App\Traits\Toggleable;
use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination, Toggleable;

    protected $paginationTheme = 'bootstrap';
    public $project;
    public $sort = true;
    public $sortField = '';
    public $active = true;
    public $search;

    protected $listeners = ['taskAssigned'];

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
            ->with(['tasktype', 'user'])
            ->when($this->active, function ($query) {
                return $query->whereNull('finished_at');
            })
            ->when($this->search, function ($query) {
                return $query->where('title', 'LIKE', '%'.$this->search.'%');
            })
            ->when($this->sortField, function ($query) {
                return $query->orderBy($this->sortField, $this->sort ? 'asc' : 'desc');
            })
            ->paginate(10);

        return view('livewire.tasks-table', compact('tasks'));
    }
}

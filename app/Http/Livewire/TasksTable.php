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
    public $sortById = 'asc';
    public $active = true;

    protected $listeners = ['taskAssigned'];

    public function taskAssigned($message)
    {
        session()->flash('message', $message);
    }

    public function orderById()
    {
        $this->sortById == 'desc' ? $this->sortById = 'asc' : $this->sortById = 'desc';
    }

    public function render()
    {
        $tasks = $this->project->tasks()
            ->when($this->active, function ($query) {
                return $query->whereNull('finished_at');
            })->orderBy('id', $this->sortById)->paginate(10);

        return view('livewire.tasks-table', compact('tasks'));
    }
}

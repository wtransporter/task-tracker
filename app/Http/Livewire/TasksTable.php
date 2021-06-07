<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class TasksTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $project;
    public $sortById = 'asc';

    public function orderById()
    {
        $this->sortById == 'desc' ? $this->sortById = 'asc' : $this->sortById = 'desc';
    }

    public function render()
    {
        $tasks = $this->project->tasks()
            ->orderBy('id', $this->sortById)->paginate(10);

        return view('livewire.tasks-table', compact('tasks'));
    }
}

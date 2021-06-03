<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TasksTable extends Component
{
    public $tasks;

    public function mount($tasks)
    {
        $this->tasks = $tasks;
    }

    public function render()
    {
        return view('livewire.tasks-table');
    }
}

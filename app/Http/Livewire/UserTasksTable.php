<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserTasksTable extends Component
{
    public $task;

    public function toggleStatus()
    {
        is_null($this->task->finished_at) ? $this->task->finished_at = now() : $this->task->finished_at = null;
        
        $this->task->save();
    }

    public function render()
    {
        return view('livewire.user-tasks-table');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AssignTaskToUser extends Component
{
    public $user_id;
    public $task;

    public function mount(){
        $this->user_id = $this->task->user_id;
    }

    public function assignTask()
    {
        $this->task->user_id = !empty($this->user_id) ? $this->user_id : null;
        $this->task->save();
        if (!empty($this->user_id)) {
            $this->emit('taskAssigned', "Task {$this->task->id} assigned to {$this->task->user->name}");
        } else {
            $this->emit('taskAssigned', "Task unassigned");
        }
    }

    public function render()
    {
        return view('livewire.assign-task-to-user');
    }
}

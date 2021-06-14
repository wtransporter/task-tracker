<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateTask extends Component
{
    public $project;
    public $title;
    public $description;
    public $note;
    public $tasktypeId;
    public $userId;
    public $startedAt;

    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'tasktypeId' => 'required',
            'userId' => 'nullable|sometimes',
            'startedAt' => 'nullable|sometimes|date'
        ];
    }

    public function loadData()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'tasktype_id' => $this->tasktypeId,
            'user_id' => $this->userId,
            'started_at' => $this->startedAt
        ];
    }

    public function store()
    {
        $this->validate();
        $this->project->tasks()->create($this->loadData());

        session()->flash('task-message', 'Task successfully added');

        $this->emitTo('tasks-table', 'taskAdded');
        
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('livewire.create-task');
    }
}

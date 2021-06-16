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
    public $status_id;
    public $due_date;

    protected function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'tasktypeId' => 'required',
            'userId' => 'nullable|sometimes',
            'startedAt' => 'nullable|sometimes|date',
            'status_id' => 'nullable|sometimes',
            'due_date' => 'nullable|sometimes|date'
        ];
    }

    protected function messages()
    {
        return [
            'tasktypeId.required' => 'Task type must be selected'
        ];
    }

    public function loadData()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'tasktype_id' => $this->tasktypeId,
            'user_id' => $this->userId,
            'started_at' => $this->startedAt,
            'status_id' => $this->status_id,
            'due_date' => $this->due_date
        ];
    }

    public function store()
    {
        $this->validate();

        $this->project->tasks()->create($this->loadData());

        session()->flash('task-message', 'Task successfully added');

        $this->resetAll();

        $this->emitTo('tasks-table', 'taskAdded');

        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        return view('livewire.create-task');
    }

    public function resetAll()
    {
        
        $this->reset([
            'title',
            'description',
            'tasktypeId',
            'userId',
            'status_id',
            'due_date'
        ]);

        $this->startedAt = now()->format('d-m-Y H:i:s');

        $this->resetValidation();
    }
}

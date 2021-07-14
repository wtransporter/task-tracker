<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    protected $errorBag = 'storetask';
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'note' => 'sometimes|required',
            'tasktype_id' => 'required',
            'user_id' => 'nullable|sometimes',
            'started_at' => 'nullable|sometimes|date',
            'status_id' => 'nullable|sometimes|exists:statuses,id',
            'due_date' => 'nullable|sometimes|date',
            'priority_id' => 'required',
            'note' => 'nullable'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (!is_null($this->started_at)) {
            $this->merge([
                'started_at' => \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $this->started_at),
            ]);
        }
    }
}

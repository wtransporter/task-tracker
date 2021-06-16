@props(['taskStatusId'])

<div {{ $attributes->merge(['class' => "form-group"]) }}>
    <label for="status_id">{{ __('Status') }}</label>
    <select wire:model="status_id" class="form-control" name="status_id" id="status_id">
        <option value="">-- Assign Status --</option>
        @foreach ($statuses as $status)
            <option value="{{ $status->id }}"
                @if(isset($taskStatusId) && $taskStatusId == $status->id)
                    selected
                @endif
                >
                {{ $status->name }}
            </option>
        @endforeach
    </select>
    <x-input-error for="status_id" />
</div>
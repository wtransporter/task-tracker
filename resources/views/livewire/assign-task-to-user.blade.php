<div class="d-flex align-items-center justify-content-between">
    <select wire:model="user_id" class="form-control h-8" name="" id="user_id">
        <option value="">-----</option>
        @foreach ($allUsers as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    <button wire:click="assignTask" type="submit" class="btn btn-ghost-info btn-sm px-1 py-0 ml-2">Assign</button>
</div>
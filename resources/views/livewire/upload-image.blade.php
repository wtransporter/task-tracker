<div class="mb-4 p-4">
    <div>
        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" class="w-32">
        @else
            <img src="{{ $user->avatar ? asset('storage') .'/'. $user->avatar : asset('img/no-image.png') }}" alt="Avatar"
                class="w-56">
        @endif
    </div>

    <input wire:model="photo" class="w-full py-2" 
        id="photo" name="photo" type="file">
    <button wire:click.prevent="upload" class="btn btn-sm btn-info" type="submit"> {{ __('Upload') }}</button>
    <button wire:click.prevent="deleteAvatar" class="btn btn-sm btn-info" type="submit"> {{ __('Remove') }}</button>
    <x-input-error for="photo" class="mt-1" />
</div>
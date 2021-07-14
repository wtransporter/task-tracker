<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;

class UploadImage extends Component
{
    use WithFileUploads;

    public $user;
    public $photo;

    protected function rules() {
        return [
            'photo' => 'image|mimes:png,jpg|max:2048'
        ];
    }

    public function upload()
    {
        $this->validate();

        $this->deleteAvatar();

        $url = $this->photo->store('images/avatars', 'public');

        $this->user->update(['avatar' => $url]);

        $this->reset('photo');
        $this->resetValidation();

        $this->dispatchBrowserEvent('swal', ['title' => 'Image uploaded']);
    }

    public function deleteAvatar()
    {
        $path = storage_path('app/public/' . $this->user->avatar);

        $this->user->update(['avatar' => null]);

        if(File::exists($path)) {
            File::delete($path);
        }
    }

    public function render()
    {
        return view('livewire.upload-image');
    }
}

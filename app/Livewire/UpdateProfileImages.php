<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class UpdateProfileImages extends Component
{
    use WithFileUploads;

    #[Rule("nullable|sometimes|image|max:5024")]
    public $profile_image;
    #[Rule("nullable|sometimes|image|max:5024")]
    public $cover_image;
    public $is_open = false;

    #[On("open-update-profile-modal")]
    public function open_modal()
    {
        $this->is_open = true;
    }

    #[On("close-update-profile-modal")]
    public function close_modal()
    {
        $this->is_open = false;
    }

    public function update_images()
    {
        $user = auth()->user();
        if ($this->profile_image !== null) {
            $validated = $this->validate([
                "profile_image" => "nullable|sometimes|image|max:5024"
            ]);
            $profile_image_path = $validated["profile_image"]->store("profile", "public");
            $user->update([
                "profile_image" => $profile_image_path
            ]);
        }
        if ($this->cover_image !== null) {
            $validated = $this->validate([
                "cover_image" => "nullable|sometimes|image|max:5024"
            ]);
            $cover_image_path = $validated["cover_image"]->store("profile", "public");
            $user->update([
                "cover_image" => $cover_image_path
            ]);
        }
        $this->dispatch("close-update-profile-modal");
        $this->reset();
    }

    public function render()
    {
        return view('livewire.update-profile-images');
    }
}

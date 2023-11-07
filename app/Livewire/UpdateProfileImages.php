<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class UpdateProfileImages extends Component
{
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

    public function render()
    {
        return view('livewire.update-profile-images');
    }
}

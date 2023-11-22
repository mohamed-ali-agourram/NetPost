<?php

namespace App\Livewire\Utilities;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;

class NavBar extends Component
{
    #[On("update-profile-image")]
    #[Computed()]
    public function authProfileImage()
    {
        return auth()->user()->profile_image();
    }

    public function render()
    {
        return view('livewire.utilities.navbar');
    }
}

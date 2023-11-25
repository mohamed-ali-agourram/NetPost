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

    #[On("notify")]
    #[Computed()]
    public function notifications_count()
    {
        return auth()->user()->unreaded_notifications->count();
    }

    public function render()
    {
        return view('livewire.utilities.navbar');
    }
}

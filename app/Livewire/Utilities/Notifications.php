<?php

namespace App\Livewire\Utilities;

use Livewire\Component;
use Livewire\Attributes\Computed;

class Notifications extends Component
{
    #[Computed()]
    public function notifications()
    {
        return auth()->user()->notifications;
    }

    public function render()
    {
        return view('livewire.utilities.notifications');
    }
}

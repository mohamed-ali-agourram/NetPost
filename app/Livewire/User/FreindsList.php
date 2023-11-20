<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class FreindsList extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.user.freinds-list');
    }
}

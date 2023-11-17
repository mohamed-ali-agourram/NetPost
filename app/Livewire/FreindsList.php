<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Computed;

class FreindsList extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.freinds-list');
    }
}

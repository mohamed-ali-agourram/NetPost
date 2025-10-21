<?php

namespace App\Livewire\Utilities;

use Livewire\Component;

class Sidebar extends Component
{
    public function logout()
    {
        auth()->logout();
        $this->redirectRoute("auth.login", navigate: true);
    }
    public function render()
    {
        return view('livewire.utilities.sidebar');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

class SideBar extends Component
{
    public function logout()
    {
        auth()->logout();
        $this->redirectRoute("auth.login", navigate: true);
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}

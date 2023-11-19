<?php

namespace App\Livewire;

use Livewire\Component;

class FreindsPage extends Component
{
    public $friends;

    public function mount()
    {
        $this->friends = auth()->user()->friends;
    }

    public function render()
    {
        return view('livewire.freinds-page');
    }
}

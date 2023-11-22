<?php

namespace App\Livewire\Utilities;

use Livewire\Component;
use Livewire\Attributes\Computed;

class MyAlert extends Component
{
    #[Computed()]
    public function is_open()
    {
        return true;
    }

    public function render()
    {
        return view('livewire.utilities.my-alert');
    }
}

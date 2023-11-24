<?php

namespace App\Livewire\Utilities;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class MyAlert extends Component
{
    public $is_open = false;

    #[On("notify-profile")]
    public function open(bool $status)
    {
        $this->is_open = $status;
    }

    public function close()
    {
        $this->is_open = false;
    }

    public function render()
    {
        return view('livewire.utilities.my-alert');
    }
}

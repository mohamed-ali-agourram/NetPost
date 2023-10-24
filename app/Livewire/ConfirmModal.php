<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmModal extends Component
{
    public $is_open = false;

    #[On("toggle-confirm-modal")]
    public function open()
    {
        $this->is_open = true;
    }

    public function close()
    {
        $this->is_open = false;
    }

    #[On("confirm-action")]
    public function confirm(string $action)
    {
        $this->dispatch($action);
        $this->close();
    }

    public function render()
    {
        return view('livewire.confirm-modal');
    }
}

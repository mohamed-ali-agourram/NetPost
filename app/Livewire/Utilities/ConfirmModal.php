<?php

namespace App\Livewire\Utilities;

use Livewire\Attributes\On;
use Livewire\Component;

class ConfirmModal extends Component
{
    public $is_open = false;
    public $action = '';
    public $data;

    #[On("toggle-confirm-modal")]
    public function open(string $action, $data = null)
    {
        $this->action = $action;
        if(!is_null($data)) {
            $this->data = $data;
        }
        $this->is_open = true;
    }

    public function close()
    {
        $this->is_open = false;
    }

    #[On("confirm-action")]
    public function confirm()
    {
        $this->dispatch($this->action, $this->data);
        $this->close();
    }

    public function render()
    {
        return view('livewire.utilities.confirm-modal');
    }
}

<?php

namespace App\Livewire\Utilities;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;
use Livewire\Attributes\Computed;

class Notifications extends Component
{
    #[On("notify")]
    #[Computed()]
    public function notifications()
    {
        return auth()->user()->notifications;
    }

    public function delete(Notification $notification)
    {
        $notification->delete();
        $this->dispatch("notify");
    }

    public function render()
    {
        return view('livewire.utilities.notifications');
    }
}

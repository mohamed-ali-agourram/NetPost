<?php

namespace App\Livewire\Utilities;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Notification;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\URL;

class Notifications extends Component
{
    public $path = '';

    public function mount()
    {
        $this->path = url()->current();
    }

    #[On("notify")]
    #[Computed()]
    public function notifications()
    {
        return auth()->user()->notifications;
    }

    public function read(Notification $notification)
    {
        if ($notification->readed == 0) {
            $notification->readed = 1;
            $notification->save();
        }
        $profileUrl = route("profile", ["slug" => $notification->reciver_->slug]);
        if ($profileUrl !== $this->path) {
            $this->redirectRoute("profile", ["slug" => $notification->reciver_->slug], navigate: true);
        }
        $this->dispatch("notify");
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

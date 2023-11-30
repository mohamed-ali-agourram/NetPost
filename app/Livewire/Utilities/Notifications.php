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

    #[On("notify-list")]
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
        $profile_slug = $notification->reciver_->slug;
        if ($notification->type === "FRIENDSHIP-REQUEST") {
            $profile_slug = $notification->sender_->slug;
        }

        $route = route("profile", ["slug" => $profile_slug]);
        if ($route !== $this->path && $notification->type) {
            $this->redirectRoute("profile", ["slug" => $profile_slug], navigate: true);
        }
        $this->dispatch("notify");
    }

    public function read_all()
    {
        auth()->user()->notifications()->where("readed", 0)->update(["readed" => 1]);
        $this->dispatch("notify");
    }

    public function delete_all()
    {
        auth()->user()->notifications()->delete();
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

<?php

namespace App\Livewire\Utilities;

use App\Models\Notification;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class MyAlert extends Component
{
    public $is_open = false;
    public $notification = null;
    public $sender = [];
    public $created_at;
    public $is_profile = false;
    public $path;

    public function mount()
    {
        $this->path = url()->current();
    }

    #[On("notify")]
    #[On("notify-profile")]
    public function open(bool $status = false, Notification $notification = null, bool $is_profile = false)
    {
        $this->is_profile = $is_profile;
        $this->is_open = $status;
        if ($notification != null && !$is_profile) {
            $this->notification = $notification->toArray();
            if ($notification->sender_ != null) {
                $this->sender["name"] = $notification->sender_->name;
                $this->sender["image"] = $notification->sender_->profile_image();
            }
            $this->created_at = Carbon::parse($notification->created_at)->diffForHumans();
            $this->dispatch('refreshTimer');
        }
    }

    public function close($notificationId = null)
    {
        if ($notificationId !== null) {
            $this->is_open = false;
            if ($notificationId != null && !$this->is_profile) {
                $notification = Notification::where("id", $notificationId)->first();
                $notification->update([
                    "is_shown" => true
                ]);
            }
        }
    }

    public function redirect_to_profile(Notification $notification = null)
    {
        $profile_slug = auth()->user()->slug;
        if ($notification != null) {
            $this->close($notification);
            $notification->is_shown_on_liste = true;
            $notification->readed = true;
            $notification->save();
            if ($notification->type === "FRIENDSHIP-REQUEST") {
                $profile_slug = $notification->sender_->slug;
            }
        }
        $route = route("profile", ["slug" => $profile_slug]);
        if ($route !== $this->path) {
            $this->redirectRoute("profile", ["slug" => $profile_slug], navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.utilities.my-alert');
    }
}

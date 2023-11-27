<?php

namespace App\Livewire\Utilities;

use App\Models\Notification;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class MyAlert extends Component
{
    public $is_open = false;
    public $notification = [];
    public $sender = [];
    public $created_at;

    // public function mount()
    // {
    //     $lastMinute = now()->subMinute();
    //     $hasNewNotification = auth()->user()->unreaded_notifications()
    //         ->where('created_at', '>', $lastMinute)
    //         ->exists();
    //     if ($hasNewNotification) {
    //         $this->open(true);
    //     }
    // }

    #[On("notify")]
    #[On("notify-profile")]
    public function open(bool $status = false, Notification $notification = null)
    {
        $this->is_open = $status;
        if (!empty($notification)) {
            $this->notification = $notification->toArray();
            $this->sender["name"] = $notification->sender_->name;
            $this->sender["image"] = $notification->sender_->profile_image();
            $this->created_at = Carbon::parse($notification->created_at)->diffForHumans();
        }
    }

    public function close(Notification $notification = null)
    {
        $this->is_open = false;
        if($notification != null)
        {
            $notification->is_shown = true;
            $notification->save();
        }
    }

    public function render()
    {
        return view('livewire.utilities.my-alert');
    }
}

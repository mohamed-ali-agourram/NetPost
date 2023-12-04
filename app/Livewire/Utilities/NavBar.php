<?php

namespace App\Livewire\Utilities;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class NavBar extends Component
{
    public function mount()
    {
        $this->checkForNewNotification();
    }

    public function boot()
    {
        $this->checkForNewNotification();
    }

    public function checkForNewNotification()
    {
        $endTime = Carbon::now();
        $startTime = $endTime->copy()->subMinutes(5);
        $formattedStartTime = $startTime->format('Y-m-d H:i:s');
        $formattedEndTime = $endTime->format('Y-m-d H:i:s');
        $period = CarbonPeriod::create($formattedStartTime, $formattedEndTime, CarbonPeriod::EXCLUDE_END_DATE);

        $notifications = auth()->user()->unreaded_notifications;
        $lastUnreadNotification = [];
        foreach ($notifications as $notification) {
            if ($period->contains($notification->created_at)) {
                $lastUnreadNotification = $notification;
            }
        }
        if (!empty($lastUnreadNotification)) {
            if ($lastUnreadNotification->is_shown == false && auth()->user()->configuration->notifications === 1) {
                $this->dispatch('notify', true, $lastUnreadNotification);
            }
            if ($lastUnreadNotification->is_shown_on_liste == false) {
                $lastUnreadNotification->is_shown_on_liste = true;
                $lastUnreadNotification->save();
                $this->dispatch('notify-list');
            }
        }
    }


    #[On("update-profile-image")]
    #[Computed()]
    public function authProfileImage()
    {
        return auth()->user()->profile_image();
    }

    public function render()
    {
        return view('livewire.utilities.navbar');
    }
}

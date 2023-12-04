<?php

namespace App\Livewire\Settings;

use App\Models\Config;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class ApplicationSettings extends Component
{
    public $theme_;
    public $notifications;

    public function mount()
    {
        $this->theme_ = $this->theme;
        $this->notifications = auth()->user()->configuration->notifications;
    }

    #[On("toggle-theme")]
    #[Computed()]
    public function theme()
    {
        return auth()->user()->configuration->theme;
    }

    public function toggle_theme()
    {
        $theme = $this->theme === "DARK" ? "LIGHT" : "DARK";
        $this->theme_ = $theme;
        $user = auth()->user();
        $config = Config::where('user_id', $user->id)->first();
        $config->theme = $theme;
        $config->save();
        Session::put('theme', $theme);
        $this->redirectRoute("settings.application", navigate: true);
    }

    public function toggle_notification()
    {
        $this->notifications = $this->notifications === 1 ? 0 : 1;
        $user = auth()->user();
        $config = Config::where('user_id', $user->id)->first();
        $config->notifications = $this->notifications;
        $config->save();
    }

    public function render()
    {
        return view('livewire.settings.application-settings');
    }
}

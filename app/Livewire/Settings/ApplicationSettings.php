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

    public function mount()
    {
        $this->theme_ = $this->theme;
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


    public function render()
    {
        return view('livewire.settings.application-settings');
    }
}

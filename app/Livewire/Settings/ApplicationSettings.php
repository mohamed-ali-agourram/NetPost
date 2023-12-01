<?php

namespace App\Livewire\Settings;

use App\Models\Config;
use Livewire\Component;

class ApplicationSettings extends Component
{
    public $theme;

    public function mount()
    {
        $this->theme = auth()->user()->configuration->theme;
    }

    public function toggle_theme()
    {
        $theme = $this->theme === "DARK" ? "LIGHT" : "DARK";
        $user = auth()->user();
        $config = Config::where('user_id', $user->id)->first();
        $config->theme = $theme;
        $config->save();
        $this->theme = $user->configuration->theme;
    }


    public function render()
    {
        return view('livewire.settings.application-settings');
    }
}

<?php

namespace App\Livewire\Settings;

use App\Models\Config;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ApplicationSettings extends Component
{

    #[On("toggle-theme")]
    #[Computed()]
    public function theme()
    {
        return auth()->user()->configuration->theme;
    }

    public function toggle_theme()
    {
        $theme = $this->theme === "DARK" ? "LIGHT" : "DARK";
        $user = auth()->user();
        $config = Config::where('user_id', $user->id)->first();
        $config->theme = $theme;
        $config->save();
        $this->dispatch("toggle-theme");
    }


    public function render()
    {
        return view('livewire.settings.application-settings');
    }
}

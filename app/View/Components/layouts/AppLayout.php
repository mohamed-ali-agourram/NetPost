<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $config_theme = auth()->user()->configuration->theme;
        $theme = session('theme', $config_theme);
        return view('layouts.app-layout', ["theme" => $theme]);
    }
}

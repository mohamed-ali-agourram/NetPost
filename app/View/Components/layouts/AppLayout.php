<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $theme;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $config_theme = auth()->user()->configuration->theme;
        $this->theme = session("theme", $config_theme || "");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view("components.layouts.app-layout");
    }
}

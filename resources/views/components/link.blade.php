<a wire:navigate href="{{ route($route) }}">
    @php
        $is_active = request()->routeIs($route) || (request()->routeIs($route) && isset($is_settings));
    @endphp
    @dump(explode('.', Route::currentRouteName())[0])
    <li class="{{ request()->routeIs($route) ? 'active' : '' }}">
        <i class="fa-solid {{ $icon }}"></i>
        <span>{{ isset($name) ? $name : $route }}</span>
    </li>
</a>

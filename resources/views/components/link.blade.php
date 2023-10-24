<a wire:navigate href="{{ route($route) }}">
    @php
        $is_settings =
            explode(
                '/',
                request()
                    ->route()
                    ->uri(),
            )[0] === 'settings' && $route === 'settings.account';
    @endphp
    <li class="{{ request()->routeIs($route) || $is_settings ? 'active' : '' }}">
        <i class="fa-solid {{ $icon }}"></i>
        <span>{{ isset($name) ? $name : $route }}</span>
    </li>
</a>

@php
    $is_settings =
        explode(
            '/',
            request()
                ->route()
                ->uri(),
        )[0] === 'settings' && $route === 'settings.account';
    $is_profile = $route === 'profile';
    $slug = auth()->user()->slug;
@endphp
<a wire:navigate href="{{ $is_profile ? route($route, ['slug' => $slug]) : route($route) }}">
    <li class="{{ request()->routeIs($route) || $is_settings ? 'active' : '' }}">
        <i class="fa-solid {{ $icon }}"></i>
        <span>{{ isset($name) ? $name : $route }}</span>
    </li>
</a>

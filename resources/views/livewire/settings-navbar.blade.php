<div class="settings_routes">
    <a wire:navigate class="{{ request()->routeIs('settings.account') ? 'active_settings' : '' }}"
        href="{{ route('settings.account') }}">Account</a>
    <a wire:navigate class="{{ request()->routeIs('settings.application') ? 'active_settings' : '' }}"
        href="{{ route('settings.application') }}">Application</a>
</div>

<x-layouts.app-layout>
    <div class="settings_main_content">
        <div class="gear" style="display: none;">
            <i class="fa-solid fa-gears"></i>
        </div>
        <livewire:settings-navbar />
        {{ $slot }}
    </div>
</x-layouts.app-layout>


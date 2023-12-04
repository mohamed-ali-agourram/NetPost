<div class="settings_content_application">
    <div class="app_settings_card">
        <div class="controls">
            <label for="theme">Theme</label>
            <div>
                <p id="theme" style="text-transform: capitalize;">{{ strtolower($theme_) }}</p>
                <div wire:click='toggle_theme' class="toggle-switch">
                    <label class="switch-label">
                        <input @checked($this->theme === "LIGHT") type="checkbox" class="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="controls">
            <label for="notifications">Notifications</label>
            <div class="checkbox-wrapper-2">
                <span>ON</span>
                <input style="cursor: pointer;" type="checkbox" class="sc-gJwTLC ikxBAC">
            </div>
        </div>
        <div class="btns controls">
            <button><i class="fa-solid fa-triangle-exclamation"></i><span>Privacy Policy</span><i
                    class="fa-solid fa-chevron-right"></i></button>
            <button><i class="fa-solid fa-circle-question"></i><span>Support</span><i
                    class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</div>

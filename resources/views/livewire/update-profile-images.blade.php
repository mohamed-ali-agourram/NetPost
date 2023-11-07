<div class="confirm_modal" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="backdrop" wire:click='$dispatch("close-update-profile-modal")'></div>
    <div class="update_image_backdrop">
        <div class="cover_pic" style="background-image: url({{ asset('images/cover_pic.jpg') }});">
            <div class="cover_backdrop">
                <p>Add a new cover</p>
                <i class='bx bx-camera'></i>
            </div>
        </div>
        <div class="p_h_body">
            <div class="profile_pic">
                <img src="{{ auth()->user()->profile_image() }}" alt="profile_pic">
                <div class="profile_backdrop">
                    <p>Add a new profile</p>
                    <i class='bx bx-camera'></i>
                </div>
            </div>
            <div class="btns">
                <button wire:click='$dispatch("close-update-profile-modal")' class="cancel">Cancel</button>
                <button class="submit">Submit</button>
            </div>
        </div>
    </div>
</div>

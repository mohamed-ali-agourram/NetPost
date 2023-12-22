<div class="confirm_modal" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="backdrop" wire:click='$dispatch("close-update-profile-modal")'></div>
    <form wire:submit.prevent='update_images' class="update_image_backdrop" enctype="multipart/form-data">
        @php
            $cover_image_src = '';
            if ($cover_image && method_exists($cover_image, 'temporaryUrl')) {
                $cover_image_src = $cover_image->temporaryUrl();
            } else {
                $cover_image_src = auth()
                    ->user()
                    ->cover_image();
            }
        @endphp
        <div class="cover_pic" style="background-image: url({{ $cover_image_src }});">
            <label for="cover-image" class="cover_backdrop">
                <p>Add a new cover</p>
                <i class='bx bx-camera'></i>
                <input wire:model="cover_image" name="cover_image" accept=".jpg, .png" type="file" id="cover-image">
                <span wire:loading wire:target="cover_image" class="spinner-backdrop">
                    <span class="lds-ripple">
                        <span></span>
                        <span></span>
                    </span>
                </span>
            </label>
            @error('cover_image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="p_h_body">
            <div class="profile_pic">
                @php
                    $profile_image_src = '';
                    if ($profile_image && method_exists($profile_image, 'temporaryUrl')) {
                        $profile_image_src = $profile_image->temporaryUrl();
                    } else {
                        $profile_image_src = auth()
                            ->user()
                            ->profile_image();
                    }
                @endphp
                <img class="preview" src="{{ $profile_image_src }}" alt="preview" />
                <label for="profile-image" class="profile_backdrop">
                    <p>Add a new profile</p>
                    <i class='bx bx-camera'></i>
                    <input wire:model="profile_image" accept=".jpg, .png" name="profile_image" type="file"
                        id="profile-image">
                    <span wire:loading wire:target="profile_image" style="border-radius: 100%" class="spinner-backdrop">
                        <span class="lds-ripple">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
                    @error('profile_image')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </label>
            </div>
        </div>
        <div class="btns">
            <button type="button" wire:click='$dispatch("close-update-profile-modal")' class="cancel">Cancel</button>
            <button class="submit">Submit</button>
        </div>
    </form>
</div>

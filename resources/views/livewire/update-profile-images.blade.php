<div class="confirm_modal" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="backdrop" wire:click='$dispatch("close-update-profile-modal")'></div>
    <form wire:submit.prevent='update_images' class="update_image_backdrop" enctype="multipart/form-data">
        @php
            $cover_image_src = '';
            if ($cover_image) {
                if (method_exists($cover_image, 'temporaryUrl')) {
                    $cover_image_src = $cover_image->temporaryUrl();
                } else {
                    $cover_image_src = asset('storage/' . $cover_image);
                }
            } else {
                $cover_image_src = asset('/images/cover_pic.jpg');
            }
        @endphp
        <div class="cover_pic"
            style="background-image: url({{ $cover_image_src }});">
            <label for="cover-image" class="cover_backdrop">
                <p>Add a new cover</p>
                <i class='bx bx-camera'></i>
                <input wire:model="cover_image" accept=".jpg, .png" type="file" id="cover-image">
            </label>
            @error('cover_image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="p_h_body">
            <div class="profile_pic">
                @php
                    $profile_image_src = '';
                    if ($profile_image) {
                        if (method_exists($profile_image, 'temporaryUrl')) {
                            $profile_image_src = $profile_image->temporaryUrl();
                        } else {
                            $profile_image_src = asset('storage/' . $profile_image);
                        }
                    } else {
                        $profile_image_src = asset('/images/default-profile.png');
                    }
                @endphp
                <img class="preview" src="{{ $profile_image_src }}" alt="preview" />
                <label for="profile-image" class="profile_backdrop">
                    <p>Add a new profile</p>
                    <i class='bx bx-camera'></i>
                    <input wire:model="profile_image" accept=".jpg, .png" name="profile_image" type="file"
                        id="profile-image">
                </label>
            </div>
            <div class="btns">
                <button type="button" wire:click='$dispatch("close-update-profile-modal")'
                    class="cancel">Cancel</button>
                <button class="submit">Submit</button>
            </div>
        </div>
    </form>
</div>

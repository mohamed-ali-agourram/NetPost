<div class="settings_content">
    <div class="acount_settings_header">
        <div class="profile_img">
            <img src="{{ $profile_image }}" alt="{{ auth()->user()->name }}">
            <button class="pp_btn" wire:click='$dispatch("open-update-profile-modal")'><i
                    class='bx bx-camera'></i></button>
        </div>
        <div class="profile_info">
            <h1>{{ auth()->user()->name }}</h1>
            <p class="status"><span style="color: grey; font-size: 15px;">status:</span> {{ auth()->user()->status }}</p>
            <div class="user_activity">
                @php
                    $friends_count = auth()
                        ->user()
                        ->friendsRelation()
                        ->count();
                    $posts_count = auth()
                        ->user()
                        ->posts->count();
                @endphp
                <p>
                    <span>{{ $friends_count }} freind{{ $friends_count > 1 ? 's' : '' }}</span>
                    <i class="fa-regular fa-user"></i>
                </p>
                <p>
                    <span>{{ $posts_count }} post{{ $posts_count > 1 ? 's' : '' }}</span>
                    <i class="fa-regular fa-images"></i>
                </p>
                <p>
                    <span>{{ $this->likes_count }}</span>
                    <i class="fa-regular fa-thumbs-up"></i>
                </p>
            </div>
        </div>
    </div>

    <ul>
        <h2>Personal Informations</h2>

        <form wire:submit.prevent='update_field("name")'>
            <li>
                <div>
                    <label for="user_name">User Name</label>
                    <input placeholder="John Doe" wire:model='name' type="text" id="user_name" name="user_name"
                        value="{{ $name }}">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
        </form>
        <form wire:submit.prevent='update_field("status")'>
            <li>
                <div>
                    <label for="status">Status</label>
                    <input placeholder="Availabale" wire:model='status' type="text" id="status" name="status"
                        value="{{ $status }}">
                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
        </form>
        <form wire:submit.prevent='update_field("email")'>
            <li>
                <div>
                    <label for="email">Email</label>
                    <input placeholder="johndoe@gmail.com" wire:model='email' type="text"
                        value="{{ $email }}">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button><i class="fa-solid fa-pen"></i><span>Edit</span></button>
            </li>
        </form>
    </ul>
    <div class="action_div">
        <p>
            <i style="color: yellow;" class="fa-solid fa-triangle-exclamation"></i>
            <span>This Acion is Permanent</span>
        </p>
        <button wire:click='$dispatch("toggle-confirm-modal", {action: "delete-account"})'>
            <i class="fa-solid fa-trash"></i>
            <span>Delete Account</span>
        </button>
    </div>
</div>

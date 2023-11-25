<div class="alert" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <button class="close" wire:click='close'><i class="fa-solid fa-xmark"></i></button>
    <div class="alert-infos">
        <div class="alert-author">
            <img src="{{ auth()->user()->profile_image() }}" alt="{{ auth()->user()->name }}'s img">
            <i class="fa-regular fa-user"></i>
        </div>
        <div class="alert-body">
            <div>
                <p style="padding: 1vh"><b>{{ auth()->user()->name }}</b> your profile has been updated successfully</p>
                <div></div>
            </div>
            <span>1 second ago</span>
        </div>
    </div>
</div>

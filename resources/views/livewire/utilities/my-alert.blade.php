<div class="alert" style="visibility: {{ $is_open ? 'visible' : 'hidden' }}">
    <button class="close" wire:click='close({{ !empty($notification) ? $notification["id"] : null }})'><i class="fa-solid fa-xmark"></i></button>
    <div class="alert-infos">
        <div class="alert-author">
            <img src="{{ !empty($notification) ? $sender["image"] : auth()->user()->profile_image() }}" alt="{{ auth()->user()->name }}'s img">
            <i class="fa-regular fa-user"></i>
        </div>
        @if (!empty($notification))
            <div class="alert-body">
                <div>
                    <p style="padding: 1vh"><b>{{ $sender["name"] }}</b> {{ $notification['body'] }}
                    </p>
                    <div></div>
                </div>
                <span>{{ $created_at }}</span>
            </div>
        @else
            <div class="alert-body">
                <div>
                    <p style="padding: 1vh"><b>{{ auth()->user()->name }}</b> your profile has been updated successfully
                    </p>
                    <div></div>
                </div>
                <span>1 second ago</span>
            </div>
        @endif
    </div>
</div>

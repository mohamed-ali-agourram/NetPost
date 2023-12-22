<div class="alert" style="display: {{ $is_open ? 'flex' : 'none' }}"
    wire:poll.5s="close({{ $notification != null ? $notification['id'] : null }})">
    <button class="close" wire:click='close({{ !empty($notification) ? $notification['id'] : null }})'><i
            class="fa-solid fa-xmark"></i></button>
    <div wire:click='redirect_to_profile({{ !empty($notification) ? $notification['id'] : null }})' class="alert-infos">
        @if (!empty($notification))
            <div class="alert-author">
                <img src="{{ $sender['image'] }}" alt="{{ $sender['name'] }}'s img">
                @if (str_contains($notification['body'], 'like'))
                    <i class="fa-light fa-thumbs-up"></i>
                @elseif (str_contains($notification['body'], 'comment'))
                    <i class="fa-regular fa-comment-dots"></i>
                @else
                    <i class="fa-light fa-users"></i>
                @endif
            </div>
            <div class="alert-body">
                <div>
                    <p style="padding: 1vh"><b>{{ $sender['name'] }}</b> {{ $notification['body'] }}
                    </p>
                    <div></div>
                </div>
                <span>{{ $created_at }}</span>
            </div>
        @else
            <div class="alert-author">
                <img src="{{ auth()->user()->profile_image() }}" alt="{{ auth()->user()->name }}'s img">
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="alert-body">
                <div>
                    <p style="padding: 1vh"><b>{{ auth()->user()->name }}</b> your profile has been updated
                        successfully</p>
                    <div></div>
                </div>
                <span>Just now</span>
            </div>
        @endif
    </div>
</div>

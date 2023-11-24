<div>
    <div class="notification_dropdown" style="display: none;"></div>
    <div class="notification" style="display: none;">
        <div class="notif_header">
            <h1>Notifications</h1>
            <div id="close_notif"><i class="fa-solid fa-ellipsis"></i></div>
        </div>
        <div class="notif_model" style="display: none;">
            <button><i class="fa-solid fa-trash"></i>Delete all</button>
            <button><i class="fa-solid fa-circle-check"></i>Mark as read</button>
        </div>
        <div class="notif_body">
            @forelse ($this->notifications as $notification)
                <div class="notif" wire:click='read({{ $notification->id }})'>
                    <div class="notif-img">
                        <img src="{{ $notification->sender_->profile_image() }}" alt="user_img">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div>
                        <p><b>{{ $notification->sender_->name }}: </b>{{ $notification->body }}</p>
                        <span style="color: rgb(84 84 215);font-size: 13px;">
                            <i class="fa-solid fa-clock"></i>
                            {{ $notification->date() }}
                        </span>
                    </div>
                    <button wire:click='delete({{ $notification->id }})' class="delete_comnt"><i
                            class="fa-solid fa-trash"></i></button>
                    @if ($notification->readed == false)
                        <div class="blue"></div>
                    @endif
                </div>
            @empty
                <h1>Empty...</h1>
            @endforelse

        </div>
    </div>
</div>

<div>
    <div class="notification_dropdown" style="display: none;"></div>
    <div class="notification" style="display: none;">
        <div class="notif_header">
            <h1>Notifications</h1>
            <div id="close_notif"><i class="fa-solid fa-ellipsis"></i></div>
        </div>
        <div class="notif_model" style="display: none;">
            <button wire:click='delete_all'><i class="fa-solid fa-trash"></i>Delete all</button>
            <button wire:click='read_all'><i class="fa-solid fa-circle-check"></i>Mark as read</button>
        </div>
        <div class="notif_body">
            @forelse ($this->notifications as $notification)
                <div class="notif">
                    <div class="_notif" wire:click='read({{ $notification->id }})'>
                        <div class="notif-img">
                            <img src="{{ $notification->sender_->profile_image() }}" alt="user_img">
                            @if (str_contains($notification->body, 'like'))
                                <i class="fa-solid fa-thumbs-up"></i>
                            @elseif (str_contains($notification->body, 'comment'))
                                <i class="fa-solid fa-comment-dots"></i>
                            @elseif (str_contains($notification->body, 'share'))
                                <i class="fa-solid fa-megaphone"></i>
                            @else
                                <i class="fa-solid fa-user-group"></i>
                            @endif
                        </div>
                        <div>
                            <p @style(['font-weight: bold' => $notification->read == false])><b>{{ $notification->sender_->name }}: </b>{{ $notification->body }}
                            </p>
                            <span style="color: rgb(84 84 215);font-size: 13px;">
                                <i class="fa-solid fa-clock"></i>
                                {{ $notification->date() }}
                            </span>
                        </div>
                        @if ($notification->read == false)
                            <div class="blue"></div>
                        @endif
                    </div>
                    <button wire:click='delete({{ $notification->id }})' class="delete_btn"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
            @empty
                <h3 class="empty-notification-list">
                    <i class="fa-regular fa-bell"></i>
                    <span>You don't have any notification for now</span>
                </h3>
            @endforelse

        </div>
    </div>
</div>

@props(['is_freindship', 'user'])
@php
    $isSender = false;
    if ($this->pendingRequest) {
        $isSender = $this->pendingRequest->pivot->sender === $user->id;
    }

@endphp
<div class="profile_cta">
    @if ($is_freindship)
        @if (auth()->user()->areFriends($user))
            <button wire:click='freinds' class="p_cta_btn add-freind"><i class="fa-solid fa-user-group"></i>
                Freinds</button>
        @elseif (!$isSender)
            <button wire:click='add_friend' class="p_cta_btn add-freind"><i class="fa-solid fa-xmark"></i>
                Cancel Request</button>
        @else
            <div class="accept-reject-btns">
                <button wire:click='handle_request(true)' class="p_cta_btn add-freind"><i
                        class="fa-solid fa-user-check"></i>
                    Accept Request</button>
                <button wire:click='handle_request(false)' class="p_cta_btn add-freind reject"><i
                        class="fa-solid fa-xmark"></i>
                    Reject Request</button>
            </div>
        @endif
    @else
        <button wire:click='add_friend' class="p_cta_btn add-freind"><i class="fa-solid fa-user-plus"></i> Add
            friend</button>
    @endif
</div>

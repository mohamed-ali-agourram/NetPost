@props(['is_freindship', 'user'])
@php
    $auth = auth()->user();
@endphp
<div class="profile_cta">
    @if ($is_freindship)
        @if ($auth->friends->contains('id', $user->id))
            <button wire:click='freinds' class="p_cta_btn add-freind"><i class="fa-solid fa-user-group"></i>
                Friends</button>
        @elseif ($auth->pendingFriendsTo->contains("id", $user->id))
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

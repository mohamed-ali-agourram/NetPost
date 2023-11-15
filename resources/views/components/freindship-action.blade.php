<div class="profile_cta">
    @if ($this->pendingRequest)
        <button wire:click='add_friend' class="p_cta_btn add-freind"><i class="fa-solid fa-xmark"></i>
            Cancel Request</button>
    @else
        <button wire:click='add_friend' class="p_cta_btn add-freind"><i class="fa-solid fa-user-plus"></i> Add
            friend</button>
    @endif
</div>

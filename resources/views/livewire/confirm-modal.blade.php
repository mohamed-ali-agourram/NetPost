<div class="confirm_modal" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div wire:click='close()' class="backdrop"></div>
    <div class="confirm_modal_content">
        <p><i class="fa-solid fa-triangle-exclamation"></i> This action is permanent!!</p>
        <span>Are you sure you want to preform this action ?</span>
        <div class="btns">
            <button wire:click='close()' class="cancel">Cancel</button>
            <button wire:click='confirm()' class="delete">Confirm</button>
        </div>
    </div>
</div>

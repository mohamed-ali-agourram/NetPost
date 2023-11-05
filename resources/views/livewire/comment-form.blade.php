<form wire:submit.prevent='{{ isset($comment) ? "update_comment" : "post_comment" }}'>
    <textarea id="commentTextArea" wire:model='body' name="body" cols="30" rows="10" placeholder="What you think about it?"></textarea>
    <button type="submit" title="send" class="send">
        <i class='bx bxs-send'></i>
    </button>
</form>

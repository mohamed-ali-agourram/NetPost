<div class="comments">
    @if (count($this->comments) > 0)
        <div wire:click='toggle_filter' class="filter">
            @if ($filter === 'newest')
                <p>Newest First</p>
                <i class="fas fa-angle-down"></i>
            @else
                <p>Oldest First</p>
                <i class="fa-solid fa-angle-up"></i>
            @endif
        </div>
    @endif
    @forelse ($this->comments as $comment)
        <div class="comment">
            <img src={{ $comment->author->profile_image() }} alt="comment-author-image">
            <div class="content">
                <div class="bubble">
                    <b>{{ $comment->author->name }}<span>&nbsp;&nbsp;{{ $comment->date() }}</span></b>
                    <p>{{ $comment->body }}</p>
                </div>
                @if (auth()->user()->id === $comment->author->id)
                    <div class="actions">
                        <span
                            wire:click='$dispatch("toggle-confirm-modal", {action: "delete-comment", data: {{ $comment->id }}})'>delete</span>
                        <span wire:click='$dispatch("update-comment", {comment: {{ $comment->id }}})'
                            onclick="focusTextarea()">update</span>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <h3 style="color: gray">Be the first to comment</h3>
    @endforelse

    <script>
        function focusTextarea() {
            document.getElementById('commentTextArea').focus();
        }
    </script>
</div>

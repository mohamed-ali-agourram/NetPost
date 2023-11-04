<div class="comments">
    <div class="filter">
        <p>Newest First</p>
        <i class="fas fa-angle-down"></i>
    </div>
    @forelse ($this->comments as $comment)
        <div class="comment">
            <img src={{ $comment->author->image() }} alt="comment-author-image">
            <div class="content">
                <div class="bubble">
                    <b>{{ $comment->author->name }}<span>&nbsp;&nbsp;{{ $comment->date() }}</span></b>
                    <p>{{ $comment->body }}</p>
                </div>
            </div>
        </div>
    @empty
        <h1>Be the first to comment</h1>
    @endforelse
</div>

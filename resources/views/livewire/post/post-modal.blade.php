<div class="post_from_model" style="display: {{ $is_open ? 'flex' : 'none' }}">
    <div class="post_from_model_backdrop" @click="$dispatch('close-modal')"></div>
    <div class="post-card-model">
        <div class="header">
            <h2>{{ $post?->author->name }}'s Post</h2>
            <button type="button" class="cancel" @click="$dispatch('close-modal')">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
        </div>
        <div class="body">
            <div class="author">
                <img src="{{ $post?->author->profile_image() }}" alt="author">
                <div>
                    <b>{{ $post?->author->name }}</b>
                    <p>
                        <span>{{ $post?->date() }}</span>
                        @if ($post?->visibility === 'public')
                            <i title="public" class="fa-solid fa-earth-africa"></i>
                        @elseif($post?->visibility === 'friends')
                            <i class="fa-solid fa-user-group"></i>
                        @else
                            <i title="private" class="fa-solid fa-lock"></i>
                        @endif
                    </p>
                </div>
            </div>
            <div class="description">
                <p>{{ $post?->body }}</p>
                @if ($post?->image)
                    <img src="{{ $post->image() }}" alt="post_img">
                @endif
            </div>
            <div class="pcf_icons">
                @php
                    $is_liked = auth()
                        ->user()
                        ->has_liked($post);
                    $comments_count = $post?->comments()->count();
                    $shares_count = $post?->shared;
                @endphp
                <button wire:loading.attr="disabled"
                    style="background: {{ $is_liked ? 'var(--like-bg)' : 'transparent' }}" wire:click="toggleLike">
                    <i style="color: {{ $is_liked ? 'red' : 'gray' }}" class="fa-solid fa-thumbs-up"></i>
                    <span class="pcf_action">Likes</span>
                    @if ($post?->likes()->count() > 0)
                        <span class="n_activity">{{ $post?->likes()->count() }}</span>
                    @endif
                </button>
                <button>
                    <i class="fa-solid fa-message"></i>
                    <span class="pcf_action">Comment{{ $comments_count > 1 ? 's' : '' }}</span>
                    <span class="n_activity">{{ $comments_count }}</span>
                </button>
                <button
                    wire:click='$dispatch("share-post", {post: {{ $post?->id }}, sharedpost: "{{ $post?->shared_post ? $post?->shared_post : $post?->id }}"})'>
                    <i class="fa-solid fa-share"></i>
                    <span class="pcf_action">Share{{ $shares_count > 1 ? 's' : '' }}</span>
                    <span class="n_activity">{{ $shares_count }}</span>
                </button>
            </div>
        </div>
        <livewire:comment.comments-list :key="$post?->pluck('id')->join(uniqid())" :post="$post">
            <div class="post-card-model-form">
                <img src="{{ auth()->user()->profile_image() }}" alt="author">
                <livewire:comment.comment-form :key="$post?->pluck('id')->join(uniqid())" :post="$post" />
            </div>
    </div>
</div>

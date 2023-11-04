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
                <img src="{{ $post?->author->image() }}" alt="author">
                <div>
                    <b>{{ $post?->author->name }}</b>
                    <p>
                        <span>{{ $post?->date() }}</span>
                        @if ($post?->is_published === '1')
                            <i title="public" class="fa-solid fa-earth-africa"></i>
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
                @endphp
                <button wire:loading.attr="disabled"
                    style="background: {{ $is_liked ? 'rgba(46, 46, 46, 0.548)' : 'transparent' }}"
                    wire:click="toggleLike">
                    <i style="color: {{ $is_liked ? 'red' : 'gray' }}" class="fa-solid fa-thumbs-up"></i>
                    <span class="pcf_action">Likes</span>
                    @if ($post?->likes()->count() > 0)
                        <span class="n_activity">{{ $post?->likes()->count() }}</span>
                    @endif
                </button>
                <button>
                    <i class="fa-solid fa-message"></i>
                    <span class="pcf_action">Comments</span>
                    <span class="n_activity">{{ $post?->comments()->count() }}</span>
                </button>
                <button>
                    <i class="fa-solid fa-share"></i>
                    <span class="pcf_action">Shares</span>
                    <span class="n_activity">11</span>
                </button>
            </div>
        </div>
        <livewire:comments-list :key="$post?->pluck('id')->join(uniqid())" :post="$post">
        <div class="form">
            <img src="{{ $post?->author->image() }}" alt="author">
            <livewire:comment-form :key="$post?->pluck('id')->join(uniqid())" :post="$post" />
        </div>
    </div>
</div>

<style>
    .radius {
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>
@php
    $addedClass = '';
    if (isset($isFirst)) {
        $addedClass = $isFirst ? 'radius' : '';
    }
@endphp
<style>
    .new_profile_pic {
        justify-content: center;
        align-items: center;
        background: #ffffff;
        padding: 1vh;

        & img {
            height: 60vh;
            width: 60vh;
            border-radius: 100%;
        }
    }
</style>
<div class="post_card {{ $addedClass }}">
    <div class="post_card_header">
        <div class="post_meta">
            <a wire:navigate href="{{ route('profile', ['slug' => $post->author->slug]) }}">
                <img src={{ $post->author->profile_image() }} alt="post_image">
            </a>
            <div>
                <a wire:navigate href="{{ route('profile', ['slug' => $post->author->slug]) }}">
                    <b>{{ $post->author->name }}</b>
                    <span>{{ $post->is_profile_update ? 'changed his profile picture' : null }}</span>
                </a>
                <p class="date_span">
                    <span>{{ $post->date() }}</span>
                    @if ($post->is_published === '1')
                        <i title="public" class="fa-solid fa-earth-africa"></i>
                    @else
                        <i title="private" class="fa-solid fa-lock"></i>
                    @endif
                </p>
            </div>
        </div>
        @if ($post->author->id === auth()->user()->id)
            <div class="open_post_options" x-data="{ isOpen: false }" @click.away="isOpen = false">
                <abbr title="manage your post">
                    <i @click="isOpen = !isOpen" class="fa-solid fa-ellipsis"></i>
                </abbr>
                <div class="manage-posts-modal" x-show="isOpen" @click="isOpen = false" x-cloak>
                    <button wire:click='$dispatch("open-form", {post: "{{ $post->id }}"})'>
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Modify post</span>
                    </button>
                    <button
                        wire:click='$dispatch("toggle-confirm-modal", {action: "delete-post", data: "{{ $post->id }}"})'>
                        <i class="fa-solid fa-trash"></i>
                        <span>Delete post</span>
                    </button>
                </div>
            </div>
        @endif
    </div>
    <div class="post_card_body {{ $post->is_profile_update ? 'new_profile_pic' : null }}">
        <p>{{ $post->body }}</p>
        @if ($post->image)
            <img src="{{ $post->image() }}" alt="post_img" width="100%">
        @endif
    </div>
    <div class="post_card_footer">
        <div class="pcf_icons">
            @php
                $is_liked = auth()
                    ->user()
                    ->has_liked($post);
            @endphp
            <button wire:loading.attr="disabled"
                style="background: {{ $is_liked ? 'rgba(46, 46, 46, 0.548)' : 'transparent' }}"
                wire:click="$dispatch('like-post', {post: '{{ $post?->id }}'})">
                <i style="color: {{ $is_liked ? 'red' : 'gray' }}" class="fa-solid fa-thumbs-up"></i>
                <span class="pcf_action">Likes</span>
                @if ($post?->likes()->count() > 0)
                    <span class="n_activity">{{ $post?->likes()->count() }}</span>
                @endif
            </button>
            <button wire:click='$dispatch("open-post-modal", {post: "{{ $post->id }}"})'>
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
        <form wire:click='$dispatch("open-post-modal", {post: "{{ $post->id }}"})' action="/" class="comment">
            <img src={{ auth()->user()->profile_image() }} alt="{{ auth()->user()->name }}">
            <input type="text" placeholder="Comment what you think">
            <button>
                <i class='bx bxs-send'></i>
            </button>
        </form>
    </div>
</div>

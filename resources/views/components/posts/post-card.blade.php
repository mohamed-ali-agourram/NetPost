@props(['post', 'is_shared' => false])
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
    if ($is_shared) {
        $addedClass = $addedClass . ' shared_post';
    }
@endphp
<style>
    .new_profile_pic {
        justify-content: center;
        align-items: center;
        padding: 1vh;
        position: relative;

        .cover_image {
            height: 60%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background: black;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            background-position: center !important;
        }

        & img {
            height: 60vh;
            width: 60vh;
            border-radius: 100%;
            z-index: 8;
            border: var(--main-color) 3px solid;
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
        @if ($post->is_profile_update)
            <div class="cover_image" style="background: url({{ $post->author->cover_image() }})"></div>
        @endif
        <p>{{ $post->body }}</p>
        @if ($post->image)
            <img src="{{ $post->image() }}" alt="post_img" width="100%">
        @endif
        @if ($post->sharedPost)
            <x-posts.post-card :key="'post-' . $post->sharedPost->id" :post="$post->sharedPost" :is_shared="true" />
        @endif
    </div>
    @if (!$is_shared)
        <div class="post_card_footer">
            <div class="pcf_icons">
                @php
                    $is_liked = auth()
                        ->user()
                        ->has_liked($post);
                    $likes_count = $post?->likes()->count();
                    $comments_count = $post?->comments()->count();
                    $shares_count = $post->shared;
                @endphp
                <button wire:loading.attr="disabled"
                    style="background: {{ $is_liked ? 'var(--like-bg)' : 'transparent' }}"
                    wire:click="$dispatch('like-post', {post: '{{ $post?->id }}'})">
                    <i style="color: {{ $is_liked ? 'red' : 'gray' }}" class="fa-solid fa-thumbs-up"></i>
                    <span class="pcf_action">Like{{ $likes_count > 1 ? 's' : '' }}</span>
                    @if ($likes_count > 0)
                        <span class="n_activity">{{ $likes_count }}</span>
                    @endif
                </button>
                <button wire:click='$dispatch("open-post-modal", {post: "{{ $post->id }}"})'>
                    <i class="fa-solid fa-message"></i>
                    <span class="pcf_action">Comment{{ $comments_count > 1 ? 's' : '' }}</span>
                    <span class="n_activity">{{ $comments_count }}</span>
                </button>
                <button
                    wire:click='$dispatch("share-post", {post: {{ $post->id }}, sharedpost: "{{ $post->shared_post ? $post->shared_post : $post->id }}"})'>
                    <i class="fa-solid fa-share"></i>
                    <span class="pcf_action">Share{{ $shares_count > 1 ? 's' : '' }}</span>
                    <span class="n_activity">{{ $shares_count }}</span>
                </button>
            </div>
            <form wire:click='$dispatch("open-post-modal", {post: "{{ $post->id }}"})' action="/"
                class="comment">
                <img src={{ auth()->user()->profile_image() }} alt="{{ auth()->user()->name }}">
                <input type="text" placeholder="Comment what you think">
                <button>
                    <i class='bx bxs-send'></i>
                </button>
            </form>
        </div>
    @endif

</div>

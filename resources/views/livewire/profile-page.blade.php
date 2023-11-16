@php
    $is_auth = $user->slug === auth()->user()->slug;
@endphp
<div class="profile_main_content">
    <div class="profile_header" style="margin-bottom: {{ !$is_auth ? '0%' : '2%' }}">
        <div class="cover_pic" style="background-image: url({{ $cover_image }});">
            @if ($is_auth)
                <button wire:click='$dispatch("open-update-profile-modal")' class="p_cta_btn"><i class='bx bx-camera'></i>
                    <p>Change Your Cover Photo</p>
                </button>
            @endif
        </div>
        <div class="p_h_body">
            <div class="phb_a">
                <div class="profile_pic">
                    <img src="{{ $profile_image }}" alt="profile_pic">
                    @if ($is_auth)
                        <button wire:click='$dispatch("open-update-profile-modal")' class="pp_btn"><i
                                class='bx bx-camera'></i></button>
                    @endif
                </div>
                <div class="profile_info">
                    <p>{{ $user->name }}</p>
                    <p class="status"><span style="color: grey; font-size: 15px;">status:</span>
                        {{ $user->status }}</p>
                    <div class="user_activity">
                        <p>
                            <span>120 freinds</span>
                            <i class="fa-regular fa-user"></i>
                        </p>
                        <p>
                            <span>2 posts</span>
                            <i class="fa-regular fa-images"></i>
                        </p>
                        <p>
                            <span>{{ $this->likes_count() }}</span>
                            <i class="fa-regular fa-thumbs-up"></i>
                        </p>
                    </div>
                </div>
            </div>
            @if ($is_auth)
                <div class="profile_cta">
                    <a wire:navigate href="{{ route('settings.account') }}" class="p_cta_btn"><i
                            class="fa-solid fa-pen"></i> Modify Your profile</a>
                </div>
            @else
                <style>
                    .add-freind {
                        background: #0866ff !important;
                        font-size: 14px !important;
                        gap: 5px !important;
                        transition: all 0.2s;

                        &:hover {
                            scale: 105%
                        }
                    }
                </style>
                <x-freindship-action :$is_freindship :$user />
            @endif

        </div>
    </div>

    <div class="profile_body">
        <div class="posts" x-data>
            @if ($is_auth)
                <x-posts.post-form-trigger />
            @endif
            <div class="modify_pubs">
                <h2>{{ $is_auth ? 'Your' : $user->name . "'s" }} Publications</h2>
                <div class="mp_btns">
                    <button id="filter_btn"><i class="fa-solid fa-arrow-up-z-a"></i>Filter</button>
                    @if ($is_auth)
                        <button><a wire:navigate href="{{ route('settings.posts') }}"><i
                                    class="fa-solid fa-gear"></i>Manage
                                Your Publications</a></button>
                    @endif
                </div>
                <div class="filters" style="display: none;">
                    <style>
                        .clicked {
                            background: black !important;
                            color: white !important
                        }
                    </style>
                    <x-sort-button filter="date" :sort_value="$sort_date" />
                    <x-sort-button filter="likes" :sort_value="$sort_likes" />
                    <x-sort-button filter="comments" :sort_value="$sort_comments" />
                    <button><i class="fa-solid fa-share"></i>Sort By Shares</button>
                </div>
            </div>
            @forelse ($this->posts as $post)
                @php
                    $isFirst = $loop->index === 0 ? true : false;
                @endphp
                <x-posts.post-card :$isFirst :key="$post?->pluck('id')->join(uniqid())" :$post />
            @empty
                <h1>Add a new Post</h1>
            @endforelse
        </div>
        <livewire:freinds-list />
    </div>
</div>

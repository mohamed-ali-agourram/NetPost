@php
    $is_auth = $user->slug === auth()->user()->slug;
@endphp
<div class="profile_main_content">
    <div class="profile_header">
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
                        @php
                            $friends_count = $this->user->friendsRelation()->count();
                            $posts_count = $this->posts->count();
                        @endphp
                        <p>
                            <span>{{ $friends_count }} freind{{ $friends_count > 1 ? 's' : '' }}</span>
                            <i class="fa-regular fa-user"></i>
                        </p>
                        <p>
                            <span>{{ $posts_count }} post{{ $posts_count > 1 ? 's' : '' }}</span>
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
            @if ($this->posts->count() > 0)
                <div class="modify_pubs">
                    <h2>{{ $is_auth ? 'Your' : $user->name . "'s" }} Publications</h2>
                    <div class="mp_btns">
                        <button id="filter_btn"><i class="fa-solid fa-arrow-up-z-a"></i>Filter</button>
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
            @endif
            @forelse ($this->posts as $post)
                @php
                    $isFirst = $loop->index === 0 ? true : false;
                @endphp
                <x-posts.post-card :$isFirst :key="$post?->pluck('id')->join(uniqid())" :$post />
            @empty
                <h2 class="empty-posts-list">
                    <i class="fa-regular fa-newspaper"></i>
                    <span>{{ $this->user->id === auth()->user()->id ? 'You' : $this->user->name }} didn't post any
                        publication yet</span>
                </h2>
            @endforelse
            @unless ($is_bottom && !$loadingMore)
                <x-skeleton />
            @endunless
            <div x-intersect="$wire.load_more()"></div>
            @if ($is_bottom)
                <div class="bottom">
                    <h2>You reached the bottom</h2>
                    <i class="fa-solid fa-anchor"></i>
                </div>
            @endif
        </div>
        <livewire:user.freinds-list :$user />
    </div>
</div>

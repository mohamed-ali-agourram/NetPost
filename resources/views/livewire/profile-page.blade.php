<div class="profile_main_content">
    <div class="profile_header">
        <div class="cover_pic" style="background-image: url({{ $cover_image }});">
            <button wire:click='$dispatch("open-update-profile-modal")' class="p_cta_btn"><i class='bx bx-camera'></i>
                <p>Change Your Cover Photo</p>
            </button>
        </div>
        <div class="p_h_body">
            <div class="phb_a">
                <div class="profile_pic">
                    <img src="{{ $profile_image }}" alt="profile_pic">
                    <button wire:click='$dispatch("open-update-profile-modal")' class="pp_btn"><i
                            class='bx bx-camera'></i></button>
                </div>
                <div class="profile_info">
                    <p>{{ auth()->user()->name }}</p>
                    <p class="status"><span style="color: grey; font-size: 15px;">status:</span>
                        {{ auth()->user()->status }}</p>
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
            <div class="profile_cta">
                <a wire:navigate href="{{ route('settings.account') }}" class="p_cta_btn"><i
                        class="fa-solid fa-pen"></i> Modify Your profile</a>
            </div>
        </div>
    </div>

    <div class="profile_body">
        <div class="posts" x-data>
            <x-posts.post-form-trigger />
            <div class="modify_pubs">
                <h2>Your Publications</h2>
                <div class="mp_btns">
                    <button id="filter_btn"><i class="fa-solid fa-arrow-up-z-a"></i>Filter</button>
                    <button><a wire:navigate href="{{ route('settings.posts') }}"><i class="fa-solid fa-gear"></i>Manage
                            Your Publications</a></button>
                </div>
                <div class="filters" style="display: none;">
                    <button><i class="fa-solid fa-clock"></i>Sort By Date</button>
                    <button><i class="fa-solid fa-thumbs-up"></i>Sort By Likes</button>
                    <button><i class="fa-solid fa-message"></i>Sort By Comments</button>
                    <button><i class="fa-solid fa-share"></i>Sort By Shares</button>
                </div>
            </div>
            @forelse ($this->posts as $post)
                @php
                    $isFirst = $loop->index === 0 ? true : false;
                @endphp
                <x-posts.post-card :$isFirst :key="$post->id" :$post />
            @empty
                <h1>Add a new Post</h1>
            @endforelse
        </div>
        <livewire:freinds-list />
    </div>
</div>

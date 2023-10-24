<x-layouts.app-layout>
    <div class="profile_main_content">
        <div class="profile_header">
            <div class="cover_pic" style="background-image: url({{ asset('images/cover_pic.jpg') }});">
                <button class="p_cta_btn"><i class='bx bx-camera'></i>
                    <p>Change Your Cover Photo</p>
                </button>
            </div>
            <div class="p_h_body">
                <div class="phb_a">
                    <div class="profile_pic">
                        <img src="{{ auth()->user()->image() }}" alt="profile_pic">
                        <button class="pp_btn"><i class='bx bx-camera'></i></button>
                    </div>
                    <div class="profile_info">
                        <p>{{ auth()->user()->name }}</p>
                        <p class="status"><span style="color: grey; font-size: 15px;">status:</span> Availabale</p>
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
                                <span>25 likes</span>
                                <i class="fa-regular fa-thumbs-up"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="profile_cta">
                    <button class="p_cta_btn"><i class="fa-solid fa-pen"></i> Modify Your profile</button>
                </div>
            </div>
        </div>

        <div class="profile_body">
            <div class="posts">
                <div class="open_model" @click="$dispatch('form-toggle')">
                    <div class="open_ps">
                        <img src="{{ auth()->user()->image() }}" alt="user">
                        <input type="text" placeholder="What are you thinking about?" readonly>
                    </div>
                    <div class="cta_icons">
                        <div class="icons">
                            <i class='bx bx-camera'></i>
                            <i class='bx bx-image-alt'></i>
                            <i class='bx bx-happy'></i>
                        </div>
                        <button>Post</button>
                    </div>
                </div>
                <div class="modify_pubs">
                    <h2>Your Publications</h2>
                    <div class="mp_btns">
                        <button id="filter_btn"><i class="fa-solid fa-arrow-up-z-a"></i>Filter</button>
                        <button><i class="fa-solid fa-gear"></i>Manage Your Publications</button>
                    </div>
                    <div class="filters" style="display: none;">
                        <button><i class="fa-solid fa-clock"></i>Sort By Date</button>
                        <button><i class="fa-solid fa-thumbs-up"></i>Sort By Likes</button>
                        <button><i class="fa-solid fa-message"></i>Sort By Comments</button>
                        <button><i class="fa-solid fa-share"></i>Sort By Shares</button>
                    </div>
                </div>
                @forelse (auth()->user()->posts as $post)
                <x-posts.post-card :$post/>
            @empty
                <h1>Add a new Post</h1>
            @endforelse
            </div>
            <livewire:freinds-list />
        </div>
    </div>
</x-layouts.app-layout>

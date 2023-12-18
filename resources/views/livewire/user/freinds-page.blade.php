<div class="friends-page">
    <div class="freinds_main_content">
        <style>
            .user-card {
                justify-content: space-between;
                flex-direction: row;
                align-items: center;
                padding: 2vh 3vh;

                & img {
                    height: 45px;
                    width: 45px;
                }

                & button {
                    width: 150px;
                    height: fit-content;
                }
            }

            .status {
                font-size: 15.5px !important;
            }
        </style>
        @forelse ($this->friends as $friend)
            <div class="user-card">
                <div class="user-card_header">
                    <img src="{{ $friend->profile_image() }}" alt="profile">
                    <div>
                        <h4>{{ $friend->name }}</h4>
                        <p class="status"><span>status: </span>{{ $friend->status }}</p>
                    </div>
                </div>
                <x-user-card-btn :$friend :is_friendpage="true" :user="$friend" />
            </div>
        @empty
            <h1 style="color: white">NO FRIENDS YET...</h1>
        @endforelse
        <div style="margin-bottom: -15px" x-intersect="$wire.load_more_friends()"></div>
        @unless (!$loadingMoreFriends)
            <x-utilities.users-skeleton />
        @endunless
    </div>
</div>

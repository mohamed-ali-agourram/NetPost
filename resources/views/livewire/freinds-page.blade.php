<div style="display: flex; flex-direction: column">
    <div class="freinds_main_content">
        @foreach ($friends as $friend)
            <div class="freind_card">
                <a wire:navigate href="{{ route('profile', ['slug' => $friend->slug]) }}" class="img">
                    <div style="background-image: url({{ $friend->profile_image() }});"></div>
                </a>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <a wire:navigate href="{{ route('profile', ['slug' => $friend->slug]) }}">
                        <h2>{{ $friend->name }}</h2>
                    </a>
                    <p style="color: rgb(97, 97, 216);">{{ $friend->status }}</p>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <p style="color: rgb(41, 202, 41);">online</p>

                    <div class="freind_action">
                        <abbr title="unfreind" class="unfreind"><i class="fa-solid fa-user-xmark"></i></abbr>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <div class="pagination:container">
        <div class="pagination:number arrow">
            <svg width="18" height="18">
                <use xlink:href="#left" />
            </svg>
            <span class="arrow:text"></span>
        </div>

        <div class="pagination:number">
            1
        </div>
        <div class="pagination:number">
            2
        </div>

        <div class="pagination:number pagination:active">
            ...
        </div>

        <div class="pagination:number">
            540
        </div>

        <div class="pagination:number arrow">
            <svg width="18" height="18">
                <use xlink:href="#right" />
            </svg>
        </div>
    </div>

    <svg class="hide">
        <symbol id="left" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </symbol>
        <symbol id="right" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </symbol>
    </svg>
</div>

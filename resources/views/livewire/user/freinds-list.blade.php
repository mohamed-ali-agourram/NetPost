<aside class="freinds_list">
    @php
        if (!isset($user)) {
            $user = auth()->user();
        }
        $friends = $user->friends;
        $is_auth = $user === auth()->user();
    @endphp
    <h1 style="text-align: center;">{{ $is_auth ? 'My Freinds' : $user->name . "'s freinds" }}</h1>
    @forelse ($friends as $friend)
        @if ($friend->slug !== $user->slug)
            <div class="freind">
                <a wire:navigate href={{ route('profile', ['slug' => $friend->slug]) }}>
                    <img src={{ $friend->profile_image() }} alt="freind">
                </a>
                <div class="freind_body">
                    <a wire:navigate href={{ route('profile', ['slug' => $friend->slug]) }}>
                        <p>{{ $friend->name }}</p>
                    </a>
                </div>
            </div>
        @endif
    @empty
        <p style="color: gray; text-align: center">No friends yet... <i class="fa-solid fa-face-sad-sweat"></i></p>
    @endforelse
    @if (auth()->user()->id === $user->id && $friends->count() > 0)
        <a wire:navigate href="{{ route('freinds') }}" style="color: rgb(74, 74, 219); text-align: center;">See All</a>
    @endif
</aside>

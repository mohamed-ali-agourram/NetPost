<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome"
        href="/css/app-wa-2e45578ecf3b28ce6383d10b8c0bf4d0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.0/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.0/css/sharp-light.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>NETPOST</title>
</head>

<body class="{{ empty($theme) ? 'dark' : $theme }}">
    <div class="container">
        <livewire:utilities.my-alert />
        <livewire:utilities.confirm-modal />
        <livewire:user.update-profile-images />
        <livewire:post.post-modal />
        <div class="post_model_dropdown" style="display: none;"></div>
        <livewire:utilities.notifications />
        <livewire:utilities.sidebar />
        <main class="content">
            <livewire:post.post-form />
            <livewire:utilities.navbar />
            {{ $slot }}
        </main>
        @php
            $route = request()
                ->route()
                ->getName();
        @endphp
        @if ($route === 'freinds-posts' || $route === 'home')
            <div class="explore explore_links">
                <p>Explore the NET</p>
                <a @class(['is_active' => $route === 'home']) wire:navigate href="{{ route('home') }}"><i
                        class="fa-solid fa-globe"></i>Freinds</a>
                <a @class(['is_active' => $route === 'freinds-posts']) wire:navigate href="{{ route('freinds-posts') }}"><i
                        class="fa-solid fa-users"></i>Community</a>
            </div>
        @endif

    </div>

    <script src="{{ asset('js/effects.js') }}"></script>
    <script src="{{ asset('js/styles.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b9106258b7.js" crossorigin="anonymous"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>NETPOST</title>
</head>

<body>
    <div class="container">
        <livewire:confirm-modal />
        <div class="post_model_dropdown" style="display: none;"></div>
        <livewire:notifications />
        <livewire:sidebar />
        <main class="content">
            <livewire:post-form />
            <livewire:navbar />
            {{ $slot }}
        </main>
    </div>

    <script src="{{ asset('js/effects.js') }}"></script>
    <script src="{{ asset('js/styles.js') }}"></script>
</body>

</html>

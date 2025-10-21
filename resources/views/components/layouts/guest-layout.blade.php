<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b9106258b7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>NETPOST</title>
</head>

<body>
    <div class="auth_container">
        <div class="form">
            {{ $slot }}
            <div class="image">
                <p class="gray form_footer">Connect to NETPOST and post to the whole world</p>
                <img src="{{ asset('images/Mention-cuate.png') }}" />
                <div>
                    <span>Created By</span>
                    <i class="fa-brands fa-github"></i>
                    <a href="https://github.com/mohamed-ali-agourram" target="_blank"
                        class="gray">mohamed-ali-agourram</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

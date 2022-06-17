<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                @yield('message')
            </div>
        </div>
    </div>
</body>

</html>

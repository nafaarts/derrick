<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-PRIMARY sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <div class="px-4 text-lg text-SECONDARY border-r-2 border-TERTIARY tracking-wider">
                    @yield('code')
                </div>

                <div class="ml-4 text-lg text-SECONDARY uppercase tracking-wider">
                    @yield('message')
                </div>
            </div>
        </div>
    </div>
</body>

</html>

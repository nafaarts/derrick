<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Derrick {{ date('Y') }}</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @yield('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.1/alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
</head>

<body class="bg-PRIMARY">
    @include('components.navbar')
    @yield('body')
    @include('components.footer')
    @yield('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#fb923c',
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Opps',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#fb923c',
            })
        </script>
    @endif
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>

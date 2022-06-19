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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.1/alpine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
    @yield('head')
</head>

<body>
    <div class="flex h-screen bg-TERTIARY font-roboto" x-data="{ sidebar: true }">
        {{-- sidebar --}}
        <div x-show="sidebar" class="h-screen" x-transition:enter="transition duration-300"
            x-transition:enter-start="transform -translate-x-full" x-transition:enter-end="transform translate-x-0"
            x-transition:leave="transition duration-300" x-transition:leave-start="transform"
            x-transition:leave-end="transform -translate-x-full">
            @include('admin._layouts.sidebar')
        </div>

        {{-- content --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- header --}}
            <header class="py-3 px-4 bg-PRIMARY z-10">
                <div class="container flex justify-between mx-auto">
                    <div class="flex gap-4">
                        <button id="sidebar-btn" class="text-2xl text-gray-400" x-on:click="sidebar = !sidebar">
                            <i class="fas " :class="sidebar ? 'fa-times' : 'fa-bars'" id="sidebar-icon"></i>
                        </button>
                        @can('isAdmin')
                            <form action="{{ route('search') }}" method="GET" class="text-xs">
                                <input type="text" name="q" placeholder="Enter reg number..">
                            </form>
                        @endcan
                    </div>
                    <div class="md:flex items-center hidden">
                        <div class="relative">
                            <div id="profile-navbar" class="flex items-center cursor-pointer">
                                <a class="text-SECONDARY/80 hover:text-SECONDARY" href="{{ route('home') }}"><i
                                        class="fas fa-arrow-left"></i></a>
                                <h3 class="text-xs text-gray-500 ml-4">{{ auth()->user()->name ?? 'No Auth Data' }}
                                </h3>
                                <button
                                    class="ml-4 relative block h-8 w-8 border rounded-full overflow-hidden focus:outline-none">
                                    <img class="h-full w-full object-cover"
                                        src="{{ asset(auth()->user()->profile_image ? 'storage/profile/' . auth()->user()->profile_image : 'img/sample.png') }}">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- main content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto ">
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
                <div class="container mx-auto px-4 py-4">
                    @yield('body')
                </div>
            </main>
        </div>
    </div>
    <script src="{{ asset('js/validation.js') }}"></script>
    @yield('scripts')
</body>

</html>

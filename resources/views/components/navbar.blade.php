    <div class="py-1 border-b border-zinc-300 bg-PRIMARY">
        <div class="derrick-container flex justify-between text-gray-700">
            <small class="font-light tracking-wide">www.derrick.id</small>
            <div class="sosmed flex items-center">
                @auth
                    <a class="bg-transparent md:mt-0 md:ml-4 text-xs border-r border-zinc-300 pr-2"
                        href="{{ route('dashboard') }}">
                        {{ auth()->user()->name }} </a>
                @endauth
                <a href="https://www.instagram.com/derrick2k22/" target="_blank" class="ml-3">
                    <i class="fab fa-fw fa-instagram-square"></i>
                </a>
                <a href="https://line.me/ti/p/@mng1518e" target="_blank" class="ml-3">
                    <i class="fab fa-fw fa-line"></i>
                </a>
                <a href="https://www.linkedin.com/company/derrick-akamigas" target="_blank" class="ml-3">
                    <i class="fab fa-fw fa-linkedin"></i>
                </a>
                <a href="mailto:derrickeksplorasiproduksi@gmail.com" target="_blank" class="ml-3">
                    <i class="fas fa-fw fa-envelope"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="antialiased bg-PRIMARY sticky top-0 z-50">
        <div class="w-full text-gray-700 bg-PRIMARY md:shadow-md shadow-none relative">
            <div x-data="{ open: false }"
                class="derrick-container flex flex-col md:items-center md:justify-between md:flex-row h-16">
                <div class="flex flex-row items-center justify-between py-4 md:shadow-none shadow-sm">
                    <a href="{{ route('home') }}"
                        class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                        <img src="{{ asset('logo.png') }}" alt=" Logo" id="main-logo" width="30">
                    </a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{ 'flex': open, 'hidden': !open }"
                    class="flex-col flex-grow hidden w-full h-fit absolute md:static pb-4 md:pb-0 md:flex md:justify-end md:flex-row md:bg-transparent bg-TERTIARY z-20 left-0"
                    style="top: 4.15rem">
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY  md:mt-0 md:ml-4 {{ Request::is('/') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="{{ route('home') }}">HOME</a>
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY md:mt-0 md:ml-4 {{ Request::is('event*') || Request::is('competition*') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="{{ route('events') }}">EVENTS</a>
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY md:mt-0 md:ml-4 {{ Request::is('gallery') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="{{ route('gallery') }}">GALLERY</a>
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY md:mt-0 md:ml-4 {{ Request::is('info*') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="{{ route('blogs') }}">INFORMATION</a>
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY md:mt-0 md:ml-4 {{ Request::is('s*') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="{{ route('sponsors') }}">SPONSORS</a>
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY md:mt-0 md:ml-4 {{ Request::is('about-us') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="{{ route('about') }}">ABOUT US</a>
                    <a class="px-4 py-2 mt-2 text-sm bg-transparent hover:md:pb-1 hover:md:border-b-2 border-SECONDARY md:mt-0 md:ml-4 {{ Request::is('about-us') ? 'font-bold text-DARKER md:border-b-2 pb-1' : 'text-gray-500' }}"
                        href="http://twb.nz/derrick2022" target="_blank">TWIBBON
                        <span
                            class="bg-green-100 text-green-800 text-xs font-semibold mr-2 animate-pulse px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">New</span></a>

                    @guest
                        <a class="px-4 py-2 mt-2 text-sm bg-SECONDARY text-white rounded-md font-bold hover:bg-SECONDARY/80 mx-3 md:mx-0 md:mt-0 md:ml-4"
                            href="{{ route('login') }}">LOGIN</a>
                    @endguest

                    @auth
                        <a class="px-4 py-2 mt-2 text-sm bg-SECONDARY text-white rounded-md font-bold hover:bg-SECONDARY/80 mx-3 md:mx-0 md:mt-0 md:ml-4"
                            href="{{ route('dashboard') }}"><i class="fas fa-fw fa-home"></i></a>
                    @endauth
                </nav>
            </div>
        </div>
    </div>

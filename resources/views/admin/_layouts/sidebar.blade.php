<div id="sidebar"
    class="h-full z-30 inset-y-0 left-0 transition duration-300 transform bg-PRIMARY overflow-y-auto translate-x-0  static inset-0 flex flex-col justify-between hide">
    <div>
        <div class="flex items-center justify-center py-7">
            <img src="{{ asset('logo.png') }}" alt=" Logo" id="main-logo" width="20">
            <h2 class="ml-2 md:block hidden"><b class="text-orange-500">DERRICK</b> <span class="text-gray-500 font-light"
                    x-text="new Date().getFullYear()"></span></h2>
        </div>
        <nav class="text-xs px-1">
            <a class=" menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('dashboard*') ? 'font-bold text-orange-500' : 'text-gray-500' }}  hover:text-white hover:bg-orange-400"
                href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span class="mx-3 hidden md:inline">Dashboard</span>
            </a>

            @can('isAdmin')
                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/blog*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('blog.index') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span class="mx-3 hidden md:inline">Blog</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/gallery*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('gallery.index') }}">
                    <i class="fas fa-fw fa-image"></i>
                    <span class="mx-3 hidden md:inline">Gallery</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/competition*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('competition.index') }}">
                    <i class="fas fa-fw fa-trophy"></i>
                    <span class="mx-3 hidden md:inline">Competition</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/event*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('event.index') }}">
                    <i class="fas fa-fw fa-calendar-days"></i>
                    <span class="mx-3 hidden md:inline">Event</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/committee*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('committee.index') }}">
                    <i class="fas fa-fw fa-user-friends"></i>
                    <span class="mx-3 hidden md:inline">Committee</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/sponsor*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('sponsor.index') }}">
                    <i class="fas fa-fw fa-handshake-angle"></i>
                    <span class="mx-3 hidden md:inline">Sponsor</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('admin/admin-management*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('admin-management.index') }}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span class="mx-3 hidden md:inline">Admin Management</span>
                </a>
            @elsecan('isRegistrant')
                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('registrant/competition*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('registrant.competition') }}">
                    <i class="fas fa-fw fa-trophy"></i>
                    <span class="mx-3 hidden md:inline">Competitions</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('registrant/member*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('registrant.member.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span class="mx-3 hidden md:inline">Members</span>
                </a>

                <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('registrant/transaction*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                    href="{{ route('registrant.transaction') }}">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span class="mx-3 hidden md:inline">Transaction</span>
                </a>
            @endcan

            <a class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 {{ Request::is('profile*') ? 'font-bold text-orange-500' : 'text-gray-500' }} hover:text-white hover:bg-orange-400"
                href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user-pen"></i>
                <span class="mx-3 hidden md:inline">Profile</span>
            </a>

            <form action="/logout" method="post">
                @csrf
                <button
                    class="menu-link md:text-xs text-lg flex rounded-md items-center mt-4 py-2 px-6 text-gray-500 hover:text-white hover:bg-orange-400 w-full"><i
                        class="fas fa-fw fa-sign-out-alt"></i>
                    <span class="mx-3 hidden md:inline">Logout</span></button>
            </form>
        </nav>
    </div>
    <footer class="text-center mt-4 p-8 text-gray-400 text-sm hidden md:block">
        <small>Copyright &copy; <strong>Derrick</strong> <span x-text="new Date().getFullYear()"></span></small>
    </footer>
</div>

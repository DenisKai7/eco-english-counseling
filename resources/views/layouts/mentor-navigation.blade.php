<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    {{-- Logo ECO Web dan link ke halaman home --}}
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/eco-logo.png') }}" alt="ECO Web Logo" class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('mentor.dashboard')" :active="request()->routeIs('mentor.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('mentor.materials.index')" :active="request()->routeIs('mentor.materials.*')">
                        {{ __('Materials') }}
                    </x-nav-link>
                    <x-nav-link :href="route('mentor.chats.index')" :active="request()->routeIs('mentor.chats.*')">
                        {{ __('Chats') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Bagian ini dimodifikasi untuk menempatkan Logout di samping keterangan akun -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center space-x-4">
                    {{-- Keterangan Akun --}}
                    <div class="text-sm font-medium text-gray-800">
                        @if (Auth::guard('web')->check() && Auth::user()->role === 'mentor')
                            {{ Auth::user()->name }}
                        @elseif (Auth::guard('mentor')->check())
                            {{ Auth::guard('mentor')->user()->name }}
                        @else
                            Mentor
                        @endif
                    </div>

                    {{-- Tombol Logout --}}
                    <form method="POST" action="{{ route('mentor.logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Hamburger (untuk tampilan mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (untuk tampilan mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('mentor.dashboard')" :active="request()->routeIs('mentor.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('mentor.materials.index')" :active="request()->routeIs('mentor.materials.*')">
                {{ __('Materials') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('mentor.chats.index')" :active="request()->routeIs('mentor.chats.*')">
                {{ __('Chats') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                {{-- Logika untuk mendapatkan nama mentor di responsive --}}
                <div class="font-medium text-base text-gray-800">
                    @if (Auth::guard('web')->check() && Auth::user()->role === 'mentor')
                        {{ Auth::user()->name }}
                    @elseif (Auth::guard('mentor')->check())
                        {{ Auth::guard('mentor')->user()->name }}
                    @else
                        Mentor
                    @endif
                </div>
                <div class="font-medium text-sm text-gray-500">
                    @if (Auth::guard('web')->check() && Auth::user()->role === 'mentor')
                        {{ Auth::user()->email }}
                    @elseif (Auth::guard('mentor')->check())
                        {{ Auth::guard('mentor')->user()->email }}
                    @endif
                </div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- Tautan Profile (jika ada rute profil untuk mentor) --}}
                {{-- <x-responsive-nav-link :href="route('mentor.profile.edit')">{{ __('Profile') }}</x-responsive-nav-link> --}}

                <form method="POST" action="{{ route('mentor.logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('mentor.logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
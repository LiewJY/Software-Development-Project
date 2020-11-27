<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>


    <nav x-data="{ open: false }" class="bg-gray-800">
        <div class="mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-14">
                <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                    <!-- Mobile menu button-->
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" x-bind:aria-expanded="open">
                        <!-- Icon when menu is closed. -->
                        <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': open, 'block': !open }" class="block h-6 w-6" x-description="Heroicon name: menu" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <!-- Icon when menu is open. -->
                        <svg x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'hidden': !open, 'block': open }" class="hidden h-6 w-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center md:items-stretch md:justify-start">
                    {{-- logo --}}
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                        <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
                    </div>
                    {{-- content --}}
                    <div class="hidden md:block sm:ml-6">
                        @guest
                        <div class="flex space-x-4">
                            <a href="{{ url('/') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Home</a>
                            <a href="{{ url('/locations') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Locations</a>
                            <a href="{{ url('/membershipplans') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Membership Plans</a>
                            <a href="{{ url('/contactus') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Contact Us</a>
                            <a href="{{ url('/aboutus') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">About Us</a>
                        </div>
                        @elseif(Auth::user()->roles == 0)
                        <div class="flex space-x-4">
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Staff</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Maintenance</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Membership Plans</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Business Report</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Locations</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Rooms</a>
                        </div>
                        @elseif(Auth::user()->roles == 1)
                        <div class="flex space-x-4">
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Reservations</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Customer</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Maintenance</a>
                        </div>
                        @elseif(Auth::user()->roles == 2)
                        <div class="flex space-x-4">
                            <a href="{{ url('/') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Home</a>
                            <a href="{{ url('/locations') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Locations</a>
                            <a href="{{ url('/membershipplans') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Membership Plans</a>
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Bookings</a>
                            <a href="{{ url('/contactus') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">Contact Us</a>
                            <a href="{{ url('/aboutus') }}" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:text-white hover:bg-gray-700">About Us</a>
                        </div>

                        @endguest
                    </div>
                </div>

                @guest
                {{-- put login and register here --}}
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700">Register</a>
                </div>
                @else
                {{-- after login is here --}}
                <div @click.away="open = false" class="ml-3 relative justify-end" x-data="{ open: false }">
                    <div>
                        <button @click="open = !open" class="text-white" id="user-menu" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                            {{ Auth::user()->name }}
                        </button>
                    </div>
                    <div x-show="open" x-description="Profile dropdown panel, show/hide based on dropdown state." x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-black" role="menuitem">Your Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-black" role="menuitem" onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                            <!-- <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-black" role="menuitem">Sign out</a>
                    </div> -->
                    </div>
                    @endguest

                </div>
            </div>

            {{-- mobile menu --}}
            <div x-description="Mobile menu, toggle classes based on menu state." x-state:on="Menu open" x-state:off="Menu closed" :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900">Dashboard</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Team</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Projects</a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Calendar</a>
                </div>
            </div>
    </nav>


    @yield('content')


</body>

</html>
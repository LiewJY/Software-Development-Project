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
    @livewireStyles
</head>

<body class="bg-white">

    <nav x-data="{ open: false }" class="bg-gray-800">
        <div class="mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-14">
                <div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
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
                <div class="flex-1 flex items-center justify-center lg:items-stretch lg:justify-start">
                    {{-- logo --}}
                    <div class="flex-shrink-0 flex items-center">
                        <x-jet-application-logo class="block h-10 w-52" />
                    </div>
                    {{-- content any chnages here need to be made to mobile view below--}}
                    <div class="hidden lg:block sm:ml-6">
                        @guest
                        <div class="flex space-x-4">
                            <x-jet-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                                {{ __('Home') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')">
                                {{ __('Locations') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('membershipplans') }}" :active="request()->routeIs('membershipplans')">
                                {{ __('Membership Plans') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('contactus') }}" :active="request()->routeIs('contactus')">
                                {{ __('Contact Us') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')">
                                {{ __('About Us') }}
                            </x-jet-nav-link>
                        </div>
                        @elseif(Auth::user()->roles == 0)
                        <div class="flex space-x-4">
                            <x-jet-nav-link href="{{ route('Staff') }}" :active="request()->routeIs('Staff')">
                                {{ __('Staff') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('maintenance') }}" :active="request()->routeIs('maintenance')">
                                {{ __('Maintenance') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('adminreservation') }}" :active="request()->routeIs('adminreservation')">
                                {{ __('Reservations') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('membership-plans') }}" :active="request()->routeIs('membership-plans')">
                                {{ __('Membership Plans') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('business-report') }}" :active="request()->routeIs('business-report')">
                                {{ __('Business Report') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('adminlocation') }}" :active="request()->routeIs('adminlocation')">
                                {{ __('Locations') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('adminrooms') }}" :active="request()->routeIs('adminrooms')">
                                {{ __('Rooms') }}
                            </x-jet-nav-link>
                        </div>
                        @elseif(Auth::user()->roles == 1)
                        <div class="flex space-x-4">
                            <x-jet-nav-link href="{{ route('reservation') }}" :active="request()->routeIs('reservation')">
                                {{ __('Reservations') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('employeecustomer') }}" :active="request()->routeIs('employeecustomer')">
                                {{ __('Customer') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('employeemaintenance') }}" :active="request()->routeIs('employeemaintenance')">
                                {{ __('Maintenance') }}
                            </x-jet-nav-link>
                        </div>
                        @elseif(Auth::user()->roles == 2)
                        <div class="flex space-x-4">
                            <x-jet-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                                {{ __('Home') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')">
                                {{ __('Locations') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('membershipplans') }}" :active="request()->routeIs('membershipplans')">
                                {{ __('Membership Plans') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                                {{ __('Bookings') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('contactus') }}" :active="request()->routeIs('contactus')">
                                {{ __('Contact Us') }}
                            </x-jet-nav-link>
                            <x-jet-nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')">
                                {{ __('About Us') }}
                            </x-jet-nav-link>
                        </div>


                        @endauth
                    </div>
                </div>

                @guest
                {{-- put login and register here --}}
                <div class="absolute right-0 flex items-center pr-2 hidden lg:block sm:ml-6">
                    <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-jet-nav-link>
                </div>
                @else
                {{-- after login is here --}}
                <div class="sm:flex sm:items-center sm:ml-6">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="text-white">{{ Auth::user()->customer->first_name}}</div>

                                <div class="ml-1 text-white">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                 this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>

            </div>

            @endauth

        </div>
        </div>

        {{-- mobile menu --}}
        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
            <div class="pt-2 pb-3 space-y-1">
                @guest

                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')">
                    {{ __('Locations') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('membershipplans') }}" :active="request()->routeIs('membershipplans')">
                    {{ __('Membership Plans') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('contactus') }}" :active="request()->routeIs('contactus')">
                    {{ __('Contact Us') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')">
                    {{ __('About Us') }}
                </x-jet-responsive-nav-link>
                <hr>
                <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-jet-responsive-nav-link>

                @elseif(Auth::user()->roles == 0)

                <x-jet-responsive-nav-link href="{{ route('Staff') }}" :active="request()->routeIs('Staff')">
                    {{ __('Staff') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('maintenance') }}" :active="request()->routeIs('maintenance')">
                    {{ __('Maintenance') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('membership-plans') }}" :active="request()->routeIs('membership-plans')">
                    {{ __('Membership Plans') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('business-report') }}" :active="request()->routeIs('business-report')">
                    {{ __('Business Report') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('adminlocation') }}" :active="request()->routeIs('adminlocation')">
                    {{ __('Locations') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('adminrooms') }}" :active="request()->routeIs('adminrooms')">
                    {{ __('Rooms') }}
                </x-jet-responsive-nav-link>

                @elseif(Auth::user()->roles == 1)

                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Reservations') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')">
                    {{ __('Customer') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('membershipplans') }}" :active="request()->routeIs('membershipplans')">
                    {{ __('Maintenance') }}
                </x-jet-responsive-nav-link>

                @elseif(Auth::user()->roles == 2)

                <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')">
                    {{ __('Locations') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('membershipplans') }}" :active="request()->routeIs('membershipplans')">
                    {{ __('Membership Plans') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('contactus') }}" :active="request()->routeIs('contactus')">
                    {{ __('Bookings') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('contactus') }}" :active="request()->routeIs('contactus')">
                    {{ __('Contact Us') }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('aboutus') }}" :active="request()->routeIs('aboutus')">
                    {{ __('About Us') }}
                </x-jet-responsive-nav-link>

                @endguest
            </div>

        </div>

    </nav>

    <div class="items-center xl:container mx-auto">

        @yield('content')

    </div>

</body>

@livewireScripts

</html>
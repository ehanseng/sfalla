<nav x-data="{ open: false, isHome: {{ request()->routeIs('home') ? 'true' : 'false' }}, scrolled: false }"
     @scroll.window="scrolled = (window.scrollY > 10)"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     :class="{ 'bg-white shadow-md': !isHome || scrolled, 'bg-transparent': isHome && !scrolled }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current transition-colors duration-300"
                                            x-bind:class="{'text-gray-800': !isHome || scrolled, 'text-white': isHome && !scrolled}" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @foreach($menuItems as $item)
                        @php
                            $isActive = request()->is(ltrim($item->url, '/'));
                        @endphp
                        <x-nav-link :href="url($item->url)" 
                                    :active="$isActive"
                                    class="transition-colors duration-300"
                                    x-bind:class="{
                                        'text-gray-900 border-indigo-400': (!isHome || scrolled) && {{ $isActive ? 'true' : 'false' }},
                                        'text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent': (!isHome || scrolled) && !{{ $isActive ? 'true' : 'false' }},
                                        'text-white border-indigo-400': isHome && !scrolled && {{ $isActive ? 'true' : 'false' }},
                                        'text-white hover:text-gray-300 border-transparent': isHome && !scrolled && !{{ $isActive ? 'true' : 'false' }}
                                    }">
                            {{ $item->title }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150"
                                    x-bind:class="{'text-gray-500 bg-white hover:text-gray-700': !isHome || scrolled, 'text-white bg-transparent hover:text-gray-300': isHome && !scrolled}">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.hero-banner.edit')">
                                {{ __('Home Settings') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.menu-items.index')">
                                {{ __('Menu Manager') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.timeline-events.index')">
                                {{ __('Timeline Events') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.posts.index')">
                                {{ __('Posts') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('admin.categories.index')">
                                {{ __('Categories') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm underline" 
                       x-bind:class="{'text-gray-700': !isHome || scrolled, 'text-white': isHome && !scrolled}">Log in</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path x-bind:class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-bind:class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-bind:class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($menuItems as $item)
                <x-responsive-nav-link :href="url($item->url)" :active="request()->is(ltrim($item->url, '/'))">
                    {{ $item->title }}
                </x-responsive-nav-link>
            @endforeach
        </div>
        {{-- Responsive Settings --}}
    </div>
</nav>

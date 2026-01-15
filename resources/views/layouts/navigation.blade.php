<nav x-data="{ open: false }" class="bg-dark-900/80 backdrop-blur-xl border-b border-purple-500/20 shadow-2xl" style="background: rgba(26, 26, 46, 0.8);">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group transition-all duration-300 hover:scale-105">
                        <x-application-logo class="block h-10 w-auto fill-current text-purple-400 group-hover:drop-shadow-[0_0_15px_rgba(167,139,250,0.8)]" />
                        <span class="font-black text-2xl bg-gradient-to-r from-purple-400 via-pink-400 to-cyan-400 bg-clip-text text-transparent tracking-tight">
                            INVENTORY
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-3 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="relative overflow-hidden group px-4 py-2 rounded-xl font-bold text-sm uppercase tracking-wider transition-all duration-300"
                        style="color: #9ca3af;">
                        <span class="relative z-10">{{ __('Dashboard') }}</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-5 py-2.5 border-2 border-purple-500/30 text-sm leading-4 font-bold rounded-xl text-purple-300 bg-gradient-to-r from-purple-900/20 to-pink-900/20 hover:from-purple-900/40 hover:to-pink-900/40 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300 shadow-lg hover:shadow-purple-500/50 hover:scale-105">
                            <div class="font-black uppercase tracking-wide" style="background: linear-gradient(135deg, #a78bfa, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4 text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div style="background: rgba(26, 26, 46, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(167, 139, 250, 0.3); border-radius: 12px; box-shadow: 0 8px 32px rgba(0,0,0,0.4);">
                            <x-dropdown-link :href="route('profile.edit')" 
                                class="hover:bg-purple-900/30 transition-all duration-300 font-semibold text-gray-300 hover:text-purple-300"
                                style="border-radius: 8px; margin: 4px;">
                                <span class="flex items-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('Profile') }}
                                </span>
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="hover:bg-red-900/30 text-red-400 hover:text-red-300 transition-all duration-300 font-semibold"
                                        style="border-radius: 8px; margin: 4px;">
                                    <span class="flex items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-purple-400 hover:bg-purple-900/20 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300 border-2 border-transparent hover:border-purple-500/30">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: rgba(26, 26, 46, 0.95); backdrop-filter: blur(20px);">
        <div class="pt-2 pb-3 space-y-2 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="hover:bg-purple-900/30 transition-all duration-300 rounded-lg font-bold text-sm uppercase tracking-wider"
                style="color: #9ca3af;">
                🏠 {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t" style="border-color: rgba(167, 139, 250, 0.2);">
            <div class="px-4 py-4 rounded-xl mx-2" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.15), rgba(236, 72, 153, 0.1)); border: 1px solid rgba(167, 139, 250, 0.3);">
                <div class="font-black text-lg uppercase tracking-wide" style="background: linear-gradient(135deg, #a78bfa, #f472b6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-semibold text-sm text-purple-400 mt-1">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-2 px-2">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="hover:bg-purple-900/30 transition-all duration-300 rounded-lg font-semibold"
                    style="color: #a78bfa;">
                    👤 {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="hover:bg-red-900/30 text-red-400 hover:text-red-300 transition-all duration-300 rounded-lg font-semibold">
                        🚪 {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
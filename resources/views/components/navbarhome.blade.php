<nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="/">
                        <img class="h-10 w-10" src="images/Kemendagri.svg" alt="Kemendagri">
                    </a>
                </div>
                <div class="hidden md:block sm:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <h3 class="text-white font-bold text-lg">Laporan Keuangan Daerah</h3>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    <!-- Profile Link -->
                    <div class="ml-3 text-white">
                        @auth
                            {{ Auth::user()->name }}
                        @endauth
                    </div>

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" @click="isOpen = !isOpen"
                                class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                @if (Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                        alt="{{ Auth::user()->name }}" class="w-8 h-8 object-cover rounded-full">
                                @else
                                    <img src="{{ asset('images/minisui.png') }}" alt=""
                                        class="w-8 h-8 object-cover rounded-full">
                                @endif
                            </button>
                        </div>

                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">

                            <!-- Your Profile Link -->
                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                            @if (Auth::check() && Auth::user()->role == 'admin')
                                <!-- User Management Link -->
                                <a href="/user-management"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-300" role="menuitem"
                                    tabindex="-1" id="user-menu-item-1">User Management</a>
                            @endif
                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit"
                                    class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-300"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    @if (Auth::user()->photo)
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                        alt="{{ Auth::user()->name }}" class="w-8 h-8 object-cover rounded-full">
                                @else
                                    <img src="{{ asset('images/minisui.png') }}" alt=""
                                        class="w-8 h-8 object-cover rounded-full">
                                @endif
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium leading-none text-white">
                        @auth
                        {{ Auth::user()->name }}
                        @endauth
                    </div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="/profile"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                    Profile</a>

                @if (Auth::check() && Auth::user()->role == 'admin')
                    <!-- User Management Link -->
                    <a href="/user-management" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        role="menuitem" tabindex="-1" id="user-menu-item-1">User Management</a>
                @endif

                
            
            </div>
        </div>
    </div>
</nav>

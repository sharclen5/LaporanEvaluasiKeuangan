@props(['province'])

<nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="/">
                        <img class="h-10 w-10" src="{{ asset('images/Kemendagri.svg') }}" alt="Kemendagri">
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <x-nav-link href="{{ url('/' . $province . '/dashboard') }}" :active="request()->is('dashboard')">
                            <button id="dashboardButton" type="button">Dashboard
                            </button>
                        </x-nav-link>

                        <div id="pndptn">
                            <x-nav-link href="{{ url('/' . $province . '/pendapatan') }}" :active="request()->is('pendapatan')">
                                <button id="pendapatanButton" data-dropdown-toggle="pendapatan"
                                    data-dropdown-delay="500" data-dropdown-trigger="hover" type="button">Pendapatan
                                </button>
                            </x-nav-link>

                            <!-- Dropdown menu -->
                            <div id="pendapatan"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="pendapatanButton">
                                    <div id="pndptnasli">
                                        <a href="{{ url('/' . $province . '/pendapatan/pendapatanaslidaerah') }}"
                                            :active="request() - > is('pendapatan/pendapatanaslidaerah')">
                                            <button id="pendapatanasliDropdownButton"
                                                data-dropdown-toggle="pendapatanasliDropdown" data-dropdown-delay="500"
                                                data-dropdown-placement="right-start" data-dropdown-trigger="hover"
                                                type="button"
                                                class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pendapatan
                                                Asli Daerah
                                                <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                            </button>
                                        </a>

                                        <div id="pendapatanasliDropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="pendapatanasliDropdownButton">
                                                <li>
                                                    <a href="{{ url('/' . $province . '/pendapatan/pendapatanaslidaerah/pajakdaerah') }}"
                                                        :active="request() - > is('pendapatan/pendapatanaslidaerah/pajakdaerah')"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pendapatan
                                                        Pajak Daerah</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/' . $province . '/pendapatan/pendapatanaslidaerah/retribusidaerah') }}"
                                                        :active="request() - > is(
                                                            'pendapatan/pendapatanaslidaerah/retribusidaerah')"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pendapatan
                                                        Retribusi Daerah</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/' . $province . '/pendapatan/pendapatanaslidaerah/phpkdd') }}"
                                                        :active="request() - > is('pendapatan/pendapatanaslidaerah/phpkdd')"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pendapatan
                                                        Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/' . $province . '/pendapatan/pendapatanaslidaerah/lainlainpad') }}"
                                                        :active="request() - > is('pendapatan/pendapatanaslidaerah/lainlainpad')"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lain-lain
                                                        PAD yang Sah</a>
                                                </li>
                                            </ul>
                                        </div>
                                        </li>
                                    </div>

                                    <li>
                                        <a href="{{ url('/' . $province . '/pendapatan/pendapatantransfer') }}"
                                            :active="request() - > is('pendapatan/pendapatantransfer')"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pendapatan
                                            Transfer</a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div id="blnj">
                            <x-nav-link href="{{ url('/' . $province . '/belanja') }}" :active="request()->is('belanja')">
                                <button id="belanjaButton" data-dropdown-toggle="belanja" data-dropdown-delay="500"
                                    data-dropdown-trigger="hover" type="button">Belanja
                                </button>
                            </x-nav-link>

                            <!-- Dropdown menu -->
                            <div id="belanja"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="belanjaButton">
                                    <div id="blnjoprs">
                                        <a href="/belanja/belanjaoperasi">
                                            <button id="belanjaoperasiDropdownButton"
                                                data-dropdown-toggle="belanjaoperasiDropdown" data-dropdown-delay="500"
                                                data-dropdown-placement="right-start" data-dropdown-trigger="hover"
                                                type="button"
                                                class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                Operasi
                                                <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                            </button>
                                        </a>

                                        <div id="belanjaoperasiDropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="belanjaoperasiDropdownButton">
                                                <li>
                                                    <a href="/belanja/belanjaoperasi/belanjapegawai"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Pegawai</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjaoperasi/belanjabarangjasa"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Barang dan Jasa</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjaoperasi/belanjabunga"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Bunga</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjaoperasi/belanjahibah"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Hibah</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjaoperasi/belanjabansos"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Bantuan Sosial</a>
                                                </li>
                                            </ul>
                                        </div>
                                        </li>
                                    </div>

                                    <div id="blnjmdl">

                                        <a href="/belanja/belanjamodal">
                                            <button id="belanjamodalDropdownButton"
                                                data-dropdown-toggle="belanjamodalDropdown" data-dropdown-delay="500"
                                                data-dropdown-placement="right-start" data-dropdown-trigger="hover"
                                                type="button"
                                                class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                Modal
                                                <svg class="w-2.5 h-2.5 ms-3 rtl:rotate-180" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                            </button>
                                        </a>

                                        <div id="belanjamodalDropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="belanjamodalDropdownButton">
                                                <li>
                                                    <a href="/belanja/belanjamodal/tanah"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Modal Tanah</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjamodal/peralatanmesin"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Modal Peralatan dan Mesin</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjamodal/gedungbangunan"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Modal Gedung dan Bangunan</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjamodal/jalanirigasijaringan"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Modal Jalan, Irigasi, dan Jaringan</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjamodal/asettetaplainnya"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Modal Aset Tetap Lainnya</a>
                                                </li>
                                                <li>
                                                    <a href="/belanja/belanjamodal/asetlainnya"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                                        Modal Aset Lainnya</a>
                                                </li>
                                            </ul>
                                        </div>
                                        </li>
                                    </div>

                                    <li>
                                        <a href="/belanja/belanjatakterduga"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                            Tak Terduga</a>
                                    </li>

                                    <li>
                                        <a href="/belanja/belanjatransfer"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Belanja
                                            Transfer</a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div id="pmbyn">
                            <x-nav-link href="{{ url('/' . $province . '/pembiayaan') }}" :active="request()->is('pembiayaan')">
                                <button id="pembiayaanButton" data-dropdown-toggle="pembiayaan"
                                    data-dropdown-delay="500" data-dropdown-trigger="hover" type="button">Pembiayaan
                                </button>
                            </x-nav-link>

                            <!-- Dropdown menu -->
                            <div id="pembiayaan"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="pembiayaanButton">
                                    <li>
                                        <a href="/pembiayaan/penerimaan"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Penerimaan
                                            Pembiayaan Daerah</a>
                                    </li>
                                    <li>
                                        <a href="/pembiayaan/pengeluaran"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pengeluaran
                                            Pembiayaan Daerah</a>
                                    </li>
                                    <li>
                                        <a href="/pembiayaan/silpa"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">SILPA</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

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
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
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
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/dashboard" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                aria-current="page">Dashboard</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Pendapatan</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Belanja</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Pembiayaan</a>
        </div>


        
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="flex-shrink-0">
                    @if (Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}"
                            class="w-8 h-8 object-cover rounded-full">
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
                    <a href="/user-management"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        role="menuitem" tabindex="-1" id="user-menu-item-1">User Management</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit"
                        class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                        role="menuitem" tabindex="-1" id="user-menu-item-2">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

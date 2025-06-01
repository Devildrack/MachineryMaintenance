<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="px-2 sm:px-2 lg:px-2 transition-all duration-300" :class="sidebarOpen ? 'ms-2' : 'ms-2'">
        <div class="flex justify-between items-center h-16">
            <!-- Botón hamburguesa -->
            {{-- <button @click="sidebarOpen = !sidebarOpen"
                class="text-gray-500 hover:text-black hover:font-bold transition-colors focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button> --}}
            <button @click="$dispatch('toggle-sidebar')"
                class="text-gray-500 hover:text-black hover:font-bold transition-colors focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>


            <!-- Dropdown de usuario -->
            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 -me-0.5 h-4 w-4" fill="none" stroke="currentColor"
                                        stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Administración -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            <i class="fas fa-cog mr-1"></i>
                            {{ __('Administrar cuenta') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            <i class="fas fa-user mr-2"></i>
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                <i class="fas fa-key mr-2"></i>
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Cerrar sesión -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<aside @mouseenter="if (!sidebarOpen && window.innerWidth >= 1024) sidebarHovered = true"
    @mouseleave="if (sidebarHovered) sidebarHovered = false" :class="(sidebarOpen || sidebarHovered) ? 'w-64' : 'w-20'"
    class="bg-white shadow-md transition-all duration-300 ease-in-out overflow-hidden">
    <!-- Logo -->
    <div class="flex items-center justify-center px-4 py-2.5 border-b">
        <span class="h-11 w-11 overflow-hidden rounded-full">
            <img src="{{ asset('image/img.jpg') }}" alt="LogoEmpresa" class="w-full h-full object-cover">
        </span>
        <span x-show="sidebarOpen || sidebarHovered" class="text-lg font-bold ms-3">NOMBRE EMPRESA</span>
    </div>

    <!-- Menú -->
    <nav class="mt-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center px-4 py-3 text-base font-medium transition-colors duration-200 rounded-md
                           text-indigo-500 hover:text-indigo-600 hover:bg-indigo-100"
                    :class="{
                        'justify-center': !(sidebarOpen || sidebarHovered),
                        'justify-start': (sidebarOpen || sidebarHovered),
                        'bg-indigo-100 text-indigo-600': window.location
                            .pathname === '{{ route('dashboard', [], false) }}'
                    }">
                    <i
                        class="fa-solid fa-gauge-high text-xl group-hover:text-indigo-600 transition-colors duration-200"></i>
                    <span x-show="sidebarOpen || sidebarHovered"
                        class="ml-4 group-hover:text-indigo-600">Dashboard</span>
                </a>
            </li>
            @can('listar usuarios')
                <li>
                    <a href="{{ route('usuarios.index') }}"
                        class="group flex items-center px-4 py-3 text-base font-medium transition-colors duration-200 rounded-md
                           text-indigo-500 hover:text-indigo-600 hover:bg-indigo-100"
                        :class="{
                            'justify-center': !(sidebarOpen || sidebarHovered),
                            'justify-start': (sidebarOpen || sidebarHovered),
                            'bg-indigo-100 text-indigo-600': window.location
                                .pathname === '{{ route('usuarios.index', [], false) }}'
                        }">
                        <i class="fa-solid fa-users text-xl group-hover:text-indigo-600 transition-colors duration-200"></i>
                        <span x-show="sidebarOpen || sidebarHovered"
                            class="ml-4 group-hover:text-indigo-600">Usuarios</span>
                    </a>
                </li>
            @endcan
            @can('listar roles')
                <li>
                    <a href="{{ route('roles.index') }}"
                        class="group flex items-center px-4 py-3 text-base font-medium transition-colors duration-200 rounded-md
                           text-indigo-500 hover:text-indigo-600 hover:bg-indigo-100"
                        :class="{
                            'justify-center': !(sidebarOpen || sidebarHovered),
                            'justify-start': (sidebarOpen || sidebarHovered),
                            'bg-indigo-100 text-indigo-600': window.location
                                .pathname === '{{ route('roles.index', [], false) }}'
                        }">
                        <i
                            class="fa-solid fa-user-shield text-xl group-hover:text-indigo-600 transition-colors duration-200"></i>
                        <span x-show="sidebarOpen || sidebarHovered" class="ml-4 group-hover:text-indigo-600">Roles y
                            Permisos</span>
                    </a>
                </li>
            @endcan
            @can('listar tipo maquinaria')
                <li>
                    <a href="{{ route('tipomaquinarias.index') }}"
                        class="group flex items-center px-4 py-3 text-base font-medium transition-colors duration-200 rounded-md
                           text-indigo-500 hover:text-indigo-600 hover:bg-indigo-100"
                        :class="{
                            'justify-center': !(sidebarOpen || sidebarHovered),
                            'justify-start': (sidebarOpen || sidebarHovered),
                            'bg-indigo-100 text-indigo-600': window.location
                                .pathname === '{{ route('tipomaquinarias.index', [], false) }}'
                        }">
                        <i
                            class="fa-solid fa-tractor text-xl group-hover:text-indigo-600 transition-colors duration-200"></i>
                        <span x-show="sidebarOpen || sidebarHovered" class="ml-4 group-hover:text-indigo-600">Tipos de
                            Maquinarias</span>
                    </a>
                </li>
            @endcan
            @can('listar maquinaria')
                <li>
                    <a href="{{ route('maquinarias.index') }}"
                        class="group flex items-center px-4 py-3 text-base font-medium transition-colors duration-200 rounded-md
                           text-indigo-500 hover:text-indigo-600 hover:bg-indigo-100"
                        :class="{
                            'justify-center': !(sidebarOpen || sidebarHovered),
                            'justify-start': (sidebarOpen || sidebarHovered),
                            'bg-indigo-100 text-indigo-600': window.location
                                .pathname === '{{ route('maquinarias.index', [], false) }}'
                        }">
                        <i
                            class="fa-solid fa-tractor text-xl group-hover:text-indigo-600 transition-colors duration-200"></i>
                        <span x-show="sidebarOpen || sidebarHovered" class="ml-4 group-hover:text-indigo-600">Maquinarias y
                            Equipos</span>
                    </a>
                </li>
            @endcan
        </ul>
    </nav>
</aside>

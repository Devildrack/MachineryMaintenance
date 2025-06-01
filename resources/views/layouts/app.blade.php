<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <x-banner />

    <div x-data="{ sidebarOpen: window.innerWidth >= 1024, sidebarHovered: false }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="min-h-screen flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Contenido derecho (navbar + main) -->
        <div class="flex flex-col flex-1 min-w-0"> <!-- 👈 IMPORTANTE -->
            <x-navbar />

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1 p-2 overflow-x-auto"> <!-- 👈 HABILITAMOS SCROLL -->
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    {{-- Toasts --}}
    @foreach (['success', 'info', 'error'] as $type)
        @if (session($type))
            <script>
                window.addEventListener('load', function() {
                    window.dispatchEvent(new CustomEvent('swal:toast', {
                        detail: {
                            background: '{{ $type }}',
                            icon: '{{ $type }}',
                            text: '{{ session($type) }}'
                        }
                    }));
                });
            </script>
        @endif
    @endforeach
</body>


</html>

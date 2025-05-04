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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="h-screen">
    {{-- <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div> --}}
    <div class="h-full flex">
        <!-- Lado izquierdo con imagen y texto centrado -->
        <div class="hidden lg:flex w-full lg:w-1/2 justify-center items-center"
            style="background: linear-gradient(rgba(2,2,2,.7),rgba(0,0,0,.7)), url('/image/maquinaria.png'); background-size: cover; background-position: center;">
            <div class="flex flex-col items-center text-center space-y-6 px-8 z-10">
                <h1 class="text-white font-bold text-4xl font-sans">Nombre Empresa</h1>
                <h1 class="text-white font-bold text-4xl font-sans">Logo</h1>
                <p class="text-white text-lg">Objetivo</p>
            </div>
        </div>

        <!-- Lado derecho con formulario -->
        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white">
            {{ $slot }}
        </div>
    </div>
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
    @if (session('verified'))
        <script>
            window.addEventListener('load', function() {
                window.dispatchEvent(new CustomEvent('swal:toast', {
                    detail: {
                        background: 'success',
                        icon: 'success',
                        text: '¡Tu correo ha sido verificado correctamente! Ya puedes iniciar sesión.',
                    }
                }));
            });
        </script>
    @endif
</body>

</html>

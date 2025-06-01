<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Error')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen p-6">
    <div class="text-center max-w-lg">
        <h1 class="text-7xl font-extrabold text-red-600 mb-4">@yield('code', 'Error')</h1>

        {{-- Aquí mostramos el icono si se define en la vista hija --}}
        @hasSection('icon')
            @yield('icon')
        @endif

        <h2 class="text-2xl font-semibold mb-2">@yield('title')</h2>
        <p class="mb-6 text-gray-600">@yield('message')</p>

        <div class="flex justify-center gap-4">
            <a href="javascript:history.back()"
                class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 text-white transition">Volver</a>
        </div>
    </div>
</body>

</html>

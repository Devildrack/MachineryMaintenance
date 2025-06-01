<x-app-layout>
    <div class="py-2 transition-all duration-300" :class="sidebarOpen ? 'ms-2' : 'ms-2'">
        <div class="px-2 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @php
                    $user = Auth::user();
                    $roles = $user->getRoleNames();
                @endphp

                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Bienvenido de nuevo, {{ $user->name }} {{ $user->last_name ?? '' }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

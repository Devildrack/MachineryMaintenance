<x-app-layout>
    <div class="py-2 transition-all duration-300" :class="sidebarOpen ? 'ms-2' : 'ms-2'">
        <div class="px-2 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-700">Usuarios</h1>
                        <div x-data="{ createModalOpen: false }">
                            @can('agregar usuarios')
                                <button @click="createModalOpen = true"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i> Agregar
                                </button>
                            @endcan
                            @include('usuarios.modalCreate', ['roles' => $roles])
                        </div>
                    </div>
                    <div class="overflow-hidden overflow-x-auto border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">ID</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Nombre</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Apellidos</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Correo Electrónico</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Rol</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">RFC</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Domicilio</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Teléfono</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Tel. Oficina</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Estatus</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500 w-10">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-base">
                                @foreach ($users as $user)
                                    <tr class="row-hover hover:bg-gray-200">
                                        <td class="px-2 py-1">{{ $user->id }}</td>
                                        <td class="px-2 py-1">{{ $user->name }}</td>
                                        <td class="px-2 py-1">{{ $user->apellidos }}</td>
                                        <td class="px-2 py-1">{{ $user->email }}</td>
                                        <td class="px-2 py-1">{{ $user->getRoleNames()->first() }}</td>
                                        <td class="px-2 py-1">{{ $user->rfc }}</td>
                                        <td class="px-2 py-1">{{ $user->domicilio }}</td>
                                        <td class="px-2 py-1">{{ $user->telefono }}</td>
                                        <td class="px-2 py-1">{{ $user->telefono_oficina }}</td>
                                        <td class="px-2 py-1">
                                            @if ($user->estatus == 1)
                                                <div
                                                    class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60">
                                                    Activo
                                                </div>
                                            @else
                                                <div
                                                    class="inline px-3 py-1 text-sm font-normal rounded-full text-red-500 gap-x-2 bg-red-100/60">
                                                    Inactivo
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-2 py-1">
                                            <div class="flex justify-end space-x-2">
                                                <div x-data="{ modalOpen: false }">
                                                    @can('editar usuarios')
                                                        <button @click="modalOpen = true"
                                                            class="inline-flex items-center gap-1 text-yellow-400 hover:text-yellow-500 transition duration-150 ease-in-out">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <span class="hidden lg:inline">Editar</span>
                                                        </button>
                                                    @endcan
                                                    @include('usuarios.modalEdit', ['roles' => $roles])
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

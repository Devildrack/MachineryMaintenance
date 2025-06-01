<x-app-layout>
    <div class="py-2 transition-all duration-300" :class="sidebarOpen ? 'ms-2' : 'ms-2'">
        <div class="px-2 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-700">Roles y Permisos</h1>
                        <div x-data="{ createRoleModalOpen: false }">
                            @can('agregar roles')
                                <button @click="createRoleModalOpen = true"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i> Agregar
                                </button>
                            @endcan
                            @include('roles.modalCreate')
                        </div>
                    </div>
                    <div class="overflow-hidden overflow-x-auto border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">ID</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Rol</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Permisos</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500 w-40">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-base">
                                @foreach ($roles as $role)
                                    <tr class="row-hover hover:bg-gray-200">
                                        <td class="px-2 py-1">{{ $role->id }}</td>
                                        <td class="px-2 py-1">{{ $role->name }}</td>
                                        <td class="px-2 py-1">
                                            @foreach ($role->permissions as $permission)
                                                <div
                                                    class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 mb-1">
                                                    {{ $permission->name }}
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="px-2 py-1">
                                            <div class="flex justify-end space-x-2">
                                                <div x-data="{ editRoleModalOpen: false }">
                                                    @can('editar roles')
                                                        <button @click="editRoleModalOpen = true"
                                                            class="inline-flex items-center gap-1 text-yellow-400 hover:text-yellow-500 transition duration-150 ease-in-out">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <span class="hidden lg:inline">Editar</span>
                                                        </button>
                                                    @endcan
                                                    @include('roles.modalEdit')
                                                </div>
                                                <div x-data="{ deleteRoleModalOpen: false }">
                                                    @can('eliminar roles')
                                                        <button @click="deleteRoleModalOpen = true"
                                                            class="inline-flex items-center gap-1 text-red-500 hover:text-red-600 transition duration-150 ease-in-out">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span class="hidden lg:inline">Eliminar</span>
                                                        </button>
                                                    @endcan
                                                    @include('roles.modalDelete')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

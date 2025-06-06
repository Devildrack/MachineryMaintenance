<x-app-layout>
    <div class="py-2 transition-all duration-300" :class="sidebarOpen ? 'ms-2' : 'ms-2'">
        <div class="px-2 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-700">Tipos de Maquinarias</h1>
                        <div x-data="{ createModalOpen: false }">
                            @can('agregar tipo maquinaria')
                                <button @click="createModalOpen = true"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i> Agregar
                                </button>
                            @endcan
                            @include('tipomaquinarias.modalCreate')
                        </div>
                    </div>
                    <div class="overflow-hidden overflow-x-auto border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">ID</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Descripción</th>
                                    <th class="px-2 py-2 font-medium text-center text-gray-500 w-40">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-base">
                                @foreach ($tipomaquinarias as $tipomaquinaria)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-2 py-1">{{ $tipomaquinaria->id }}</td>
                                        <td class="px-2 py-1">{{ $tipomaquinaria->descripcion }}</td>
                                        <td class="px-2 py-1">
                                            <div class="flex justify-end space-x-2">
                                                <div x-data="{ editOpen: false }" class="inline-block">
                                                    @can('editar tipo maquinaria')
                                                        <button @click="editOpen = true"
                                                            class="inline-flex items-center gap-1 text-yellow-400 hover:text-yellow-500 transition duration-150 ease-in-out">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <span class="hidden lg:inline">Editar</span>
                                                        </button>
                                                    @endcan
                                                    @include('tipomaquinarias.modalEdit')
                                                </div>

                                                <div x-data="{ deleteOpen: false }" class="inline-block">
                                                    @can('eliminar tipo maquinaria')
                                                        <button @click="deleteOpen = true"
                                                            class="inline-flex items-center gap-1 text-red-500 hover:text-red-600 transition duration-150 ease-in-out">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span class="hidden lg:inline">Eliminar</span>
                                                        </button>
                                                    @endcan
                                                    @include('tipomaquinarias.modalDelete')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $tipomaquinarias->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

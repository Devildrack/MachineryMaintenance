<x-app-layout>
    <div class="py-2 transition-all duration-300" :class="sidebarOpen ? 'ms-2' : 'ms-2'">
        <div class="px-2 sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Encabezado -->
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-bold text-gray-700">Maquinarias y Equipos</h1>
                        <div x-data="{ createModalOpen: false }">
                            @can('agregar maquinaria')
                                <button @click="createModalOpen = true"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i> Agregar
                                </button>
                            @endcan
                            @include('maquinarias.modalCreate')
                        </div>
                    </div>
                    <div class="overflow-hidden overflow-x-auto border border-gray-200 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">ID</th>
                                    <th class="px-2 py-2 font-medium text-left text-gray-500">Descripción</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Tipo</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Modelo</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Marca</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">N° Serie</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Propietario</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Frente Trabajo</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Fecha Alta</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Combustible</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Últ. Servicio</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Horómetro</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Condición</th>
                                    <th class="px-2 py-2 text-left font-medium text-gray-500">Estatus</th>
                                    <th class="px-2 py-2 font-medium text-center text-gray-500 w-40">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 text-base">
                                @foreach ($maquinarias as $maquinaria)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-2 py-1">{{ $maquinaria->id }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->descripcion }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->tipo->descripcion }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->modelo }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->marca }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->numero_serie }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->propietario }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->frenteTrabajo->descripcion }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->fecha_alta }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->tipo_combustible }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->fecha_ultimo_servicio }}</td>
                                        <td class="px-2 py-1">{{ $maquinaria->horometro_ultimo_servicio }}</td>
                                        <td class="px-2 py-1">
                                            @if ($maquinaria->condicion == 'En Operación')
                                                <span
                                                    class="inline-block px-2 py-1 text-sm font-normal rounded-full text-emerald-500 bg-emerald-100/60">
                                                    Operación
                                                </span>
                                            @elseif ($maquinaria->condicion == 'Mantenimiento')
                                                <span
                                                    class="inline-block px-2 py-1 text-sm font-normal rounded-full text-yellow-500 bg-yellow-100/60">
                                                    Mantenimiento
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-1">
                                            @if ($maquinaria->estatus == 'Activo')
                                                <span
                                                    class="inline-block px-2 py-1 text-sm font-normal rounded-full text-emerald-500 bg-emerald-100/60">
                                                    Activo
                                                </span>
                                            @elseif ($maquinaria->estatus == 'Inactivo')
                                                <span
                                                    class="inline-block px-2 py-1 text-sm font-normal rounded-full text-red-500 bg-red-100/60">
                                                    Inactivo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-1">
                                            <div class="flex justify-end space-x-2">
                                                <div x-data="{ editOpen: false }" class="inline-block">
                                                    @can('editar maquinaria')
                                                        <button @click="editOpen = true"
                                                            class="inline-flex items-center gap-1 text-yellow-400 hover:text-yellow-500 transition duration-150 ease-in-out">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <span class="hidden lg:inline">Editar</span>
                                                        </button>
                                                    @endcan
                                                    @include('maquinarias.modalEdit')
                                                </div>

                                                <div x-data="{ deleteOpen: false }" class="inline-block">
                                                    @can('eliminar maquinaria')
                                                        <button @click="deleteOpen = true"
                                                            class="inline-flex items-center gap-1 text-red-500 hover:text-red-600 transition duration-150 ease-in-out">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span class="hidden lg:inline">Eliminar</span>
                                                        </button>
                                                    @endcan
                                                    @include('maquinarias.modalDelete')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $maquinarias->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

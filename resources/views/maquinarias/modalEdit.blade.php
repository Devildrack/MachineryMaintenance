<!-- Modal de Editar Maquinarias/Equipos -->
<div x-show="editOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="editOpen = false" class="bg-white rounded-lg shadow-lg p-4 w-full max-w-2xl relative">
        <h2 class="text-xl font-bold mb-4">Editar Maquinaria y/o Equipo</h2>

        <form action="{{ route('maquinarias.update', $maquinaria) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Descripción y Tipo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Descripción</label>
                    <input type="text" name="descripcion" value="{{ old('descripcion', $maquinaria->descripcion) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                </div>

                <div>
                    <label class="block font-medium">Tipo</label>
                    <select name="tipo_maquinaria_equipo_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                        <option value="">-- Selecciona --</option>
                        @foreach ($tipomaquinarias as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ $tipo->id == old('tipo_maquinaria_equipo_id', $maquinaria->tipo_maquinaria_equipo_id) ? 'selected' : '' }}>
                                {{ $tipo->descripcion }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Modelo y Marca -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Modelo</label>
                    <input type="text" name="modelo" value="{{ old('modelo', $maquinaria->modelo) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>

                <div>
                    <label class="block font-medium">Marca</label>
                    <input type="text" name="marca" value="{{ old('marca', $maquinaria->marca) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
            </div>

            <!-- Serie y Propietario -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Número de Serie</label>
                    <input type="text" name="numero_serie"
                        value="{{ old('numero_serie', $maquinaria->numero_serie) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>

                <div>
                    <label class="block font-medium">Propietario</label>
                    <input type="text" name="propietario" value="{{ old('propietario', $maquinaria->propietario) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
            </div>

            <!-- Frente Trabajo y Fecha Alta -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Frente de Trabajo</label>
                    <select name="frente_trabajo_id"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                        <option value="">-- Selecciona --</option>
                        @foreach ($frenteTrabajos as $frente)
                            <option value="{{ $frente->id }}"
                                {{ $frente->id == old('frente_trabajo_id', $maquinaria->frente_trabajo_id) ? 'selected' : '' }}>
                                {{ $frente->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('frente_trabajo_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Fecha de Alta</label>
                    <input type="date" name="fecha_alta" value="{{ old('fecha_alta', $maquinaria->fecha_alta) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
            </div>

            <!-- Combustible y Último Servicio -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Tipo de Combustible</label>
                    <input type="text" name="tipo_combustible"
                        value="{{ old('tipo_combustible', $maquinaria->tipo_combustible) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>

                <div>
                    <label class="block font-medium">Fecha Último Servicio</label>
                    <input type="date" name="fecha_ultimo_servicio"
                        value="{{ old('fecha_ultimo_servicio', $maquinaria->fecha_ultimo_servicio) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                </div>
            </div>

            <!-- Horómetro y Condición -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Horómetro Último Servicio</label>
                    <input type="number" name="horometro_ultimo_servicio"
                        value="{{ old('horometro_ultimo_servicio', $maquinaria->horometro_ultimo_servicio) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        min="0">
                </div>

                <div>
                    <label class="block font-medium">Condición</label>
                    <select name="condicion"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                        <option value="En Operación"
                            {{ old('condicion', $maquinaria->condicion) == 'En Operación' ? 'selected' : '' }}>
                            En Operación
                        </option>
                        <option value="Mantenimiento"
                            {{ old('condicion', $maquinaria->condicion) == 'Mantenimiento' ? 'selected' : '' }}>
                            Mantenimiento
                        </option>
                    </select>
                </div>
            </div>

            <!-- Estatus -->
            <div class="mt-4">
                <label class="block font-medium">Estatus</label>
                <select name="estatus"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                    required>
                    <option value="Activo" {{ old('estatus', $maquinaria->estatus) == 'Activo' ? 'selected' : '' }}>
                        Activo
                    </option>
                    <option value="Inactivo"
                        {{ old('estatus', $maquinaria->estatus) == 'Inactivo' ? 'selected' : '' }}>
                        Inactivo
                    </option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" @click="editOpen = false"
                    class="px-4 py-2 bg-red-500 text-white rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
            </div>
        </form>
    </div>
</div>

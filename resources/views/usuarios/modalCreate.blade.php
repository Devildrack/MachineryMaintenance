<!-- Modal de Crear Usuario -->
<div x-show="createModalOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="createModalOpen = false" class="bg-white rounded-lg shadow-lg p-4 w-full max-w-2xl relative">
        <h2 class="text-xl font-bold mb-4">Crear Nuevo Usuario</h2>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <!-- Nombre y Apellidos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Nombre</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Apellidos</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    @error('apellidos')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Email y RFC -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">RFC</label>
                    <input type="text" name="rfc" value="{{ old('rfc') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    @error('rfc')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Domicilio -->
            <div class="mt-4">
                <label class="block font-medium">Domicilio</label>
                <textarea name="domicilio" rows="2"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('domicilio') }}</textarea>
                @error('domicilio')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Teléfono y Teléfono Oficina -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Teléfono</label>
                    <input type="text" name="telefono" maxlength="10" value="{{ old('telefono') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    @error('telefono')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Teléfono Oficina</label>
                    <input type="text" name="telefono_oficina" maxlength="10" value="{{ old('telefono_oficina') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    @error('telefono_oficina')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Rol -->
            <div class="mt-4">
                <label class="block font-medium">Rol</label>
                <select name="role"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                    required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('role') == $rol->id ? 'selected' : '' }}>
                            {{ $rol->name }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" @click="createModalOpen = false"
                    class="px-4 py-2 bg-red-500 text-white rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>

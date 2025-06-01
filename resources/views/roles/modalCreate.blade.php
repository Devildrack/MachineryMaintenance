<!-- Modal de Crear Rol -->
<div x-show="createRoleModalOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="createRoleModalOpen = false"
        class="bg-white rounded-lg shadow-lg p-4 w-full max-w-5xl relative overflow-y-auto max-h-[90vh]">
        <h2 class="text-xl font-bold mb-4">Crear Nuevo Rol</h2>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Nombre del Rol</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2"
                    required>
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Permisos agrupados por módulo -->
            <div class="mb-4">
                <label class="block font-medium mb-2">Permisos</label>
                @php
                    // Agrupar permisos por módulo (última palabra del permiso)
                    $modules = collect($permissions)->groupBy(function ($perm) {
                        $words = explode(' ', $perm->name);
                        return ucfirst(array_pop($words)); // Ejemplo: 'usuarios' => 'Usuarios'
                    });
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach ($modules as $module => $perms)
                        <div class="bg-gray-100 rounded-lg p-4 shadow-sm">
                            <h3 class="font-semibold text-gray-800 mb-3 capitalize border-b pb-1">
                                {{ $module }}
                            </h3>
                            <div class="space-y-2 mt-2">
                                @foreach ($perms as $perm)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                            id="perm_{{ $perm->id }}" class="text-blue-600 rounded">
                                        <span>
                                            {{ $perm->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" @click="createRoleModalOpen = false"
                    class="px-4 py-2 bg-red-500 text-white rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Editar Rol -->
<div x-show="editRoleModalOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="editRoleModalOpen = false"
        class="bg-white rounded-lg shadow-lg p-4 w-full max-w-5xl relative overflow-y-auto max-h-[90vh]">
        <h2 class="text-xl font-bold mb-4">Editar Rol</h2>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-medium">Nombre del
                    Rol</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}"
                    class="w-full border rounded p-2" required>
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Permisos agrupados por módulo -->
            <div class="mb-4">
                <label class="block font-medium mb-2">Permisos</label>
                {{-- @php
                    // Agrupar permisos por módulo (última palabra del permiso)
                    $modules = collect($permissions)->groupBy(function ($perm) {
                        $words = explode(' ', $perm->name);
                        return ucfirst(array_pop($words)); // Ejemplo: 'usuarios' => 'Usuarios'
                    });
                    // Obtener IDs de permisos asignados al rol actual
                    $rolePermissionsIds = $role->permissions->pluck('id')->toArray();
                @endphp --}}
                @php
                    // Agrupar permisos por módulo, manejando el caso especial de "tipo maquinaria"
                    $modules = collect($permissions)->groupBy(function ($perm) {
                        $name = strtolower($perm->name);

                        if (str_contains($name, 'tipo maquinaria')) {
                            return 'Tipo Maquinaria';
                        }

                        // Lógica general: agrupar por la última palabra
                        $words = explode(' ', $perm->name);
                        return ucfirst(array_pop($words));
                    });

                    // Obtener IDs de permisos asignados al rol actual
                    $rolePermissionsIds = $role->permissions->pluck('id')->toArray();
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach ($modules as $module => $perms)
                        <div class="bg-gray-100 rounded-lg p-4 shadow-sm">
                            <h3 class="font-semibold text-gray-800 mb-3 capitalize border-b pb-1">
                                {{ $module }}
                            </h3>
                            <div class="space-y-2 mt-2">
                                @foreach ($perms as $perm)
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                                            id="perm_{{ $perm->id }}" class="text-blue-600 rounded"
                                            {{ in_array($perm->id, old('permissions', $rolePermissionsIds)) ? 'checked' : '' }}>
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
                <button type="button" @click="editRoleModalOpen = false"
                    class="px-4 py-2 bg-red-500 text-white rounded">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
            </div>
        </form>
    </div>
</div>

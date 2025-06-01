<!-- Modal de Confirmación para Eliminar Rol -->
<div x-show="deleteRoleModalOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="deleteRoleModalOpen = false" class="bg-white rounded-lg shadow-lg p-4 w-full max-w-md mx-4">
        <h2 class="text-lg font-bold mb-4">Confirmar Eliminación
        </h2>
        <p class="mb-4">¿Seguro que deseas eliminar el rol:
            <strong>{{ $role->name }}</strong>?
        </p>
        <div class="flex justify-end gap-2">
            <button type="button" @click="deleteRoleModalOpen = false"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</button>
            </form>
        </div>
    </div>
</div>

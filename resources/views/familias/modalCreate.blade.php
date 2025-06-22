<!-- Modal de Crear Familias -->
<div x-show="createModalOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="createModalOpen = false" class="bg-white rounded-lg shadow-lg p-4 w-full max-w-2xl relative">
        <h2 class="text-xl font-bold mb-4">Crear Nueva Familia</h2>

        <form action="{{ route('familias.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Descripción</label>
                <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                    class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                @error('descripcion')
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

<!-- Modal editar -->
<div x-show="editOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="editOpen = false" class="bg-white rounded-lg shadow-lg p-4 w-full max-w-2xl relative">
        <h2 class="text-xl font-bold mb-4">Editar Familia</h2>
        <form action="{{ route('familias.update', $familia) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-medium">Descripción</label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $familia->descripcion) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm mt-1" required>
                @error('descripcion')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" @click="editOpen = false"
                    class="bg-red-500 text-white px-4 py-2 rounded">Cancelar</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </form>
    </div>
</div>

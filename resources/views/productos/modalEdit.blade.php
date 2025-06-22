<!-- Modal de Editar Producto -->
<div x-show="editOpen" x-transition
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-start pt-20" style="display: none;">
    <div @click.outside="editOpen = false" class="bg-white rounded-lg shadow-lg p-4 w-full max-w-2xl relative">
        <h2 class="text-xl font-bold mb-4">Editar Producto</h2>

        <form action="{{ route('productos.update', $producto) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Descripción y Unidad -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Descripción</label>
                    <input type="text" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('descripcion')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Unidad de Medida</label>
                    <select name="unidad_medida_id" required
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">Seleccionar Unidad de Medida</option>
                        @foreach ($unidadMedidas as $unidad)
                            <option value="{{ $unidad->id }}"
                                {{ old('unidad_medida_id', $producto->unidad_medida_id) == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_medida_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Precio y Stock Minimo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">Precio</label>
                    <input type="text" name="precio" min="0.00" step="0.01"
                        value="{{ old('precio', $producto->precio) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('precio')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Stock Minimo</label>
                    <input type="number" name="stock_minimo" value="{{ old('stock_minimo', $producto->stock_minimo) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('stock_minimo')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- En Existencia y Cantidad Pedida -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block font-medium">En Existencia</label>
                    <input type="number" name="existencia" value="{{ old('existencia', $producto->existencia) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('en_existencia')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium">Cantidad Pedida</label>
                    <input type="number" name="cantidad_pedida"
                        value="{{ old('cantidad_pedida', $producto->cantidad_pedida) }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        required>
                    @error('cantidad_pedida')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Familia -->
            <div class="mt-4">
                <label class="block font-medium">Familia</label>
                <select name="familia_id" required
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Seleccionar Familia</option>
                    @foreach ($familias as $familia)
                        <option value="{{ $familia->id }}"
                            {{ old('familia_id', $producto->familia_id) == $familia->id ? 'selected' : '' }}>
                            {{ $familia->descripcion }}
                        </option>
                    @endforeach
                </select>
                @error('familia_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
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

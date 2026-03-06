<x-layouts.app :title="__('Crear Categoría')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Crear Nueva Categoría</h1>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('categorias.store') }}" class="bg-white rounded-lg shadow p-6">
                @csrf

                <!-- Nombre de la categoría -->
                <div class="mb-4">
                    <label for="nombre_categoria" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre de la categoría *
                    </label>
                    <input type="text" 
                           id="nombre_categoria" 
                           name="nombre_categoria" 
                           value="{{ old('nombre_categoria') }}"
                           class="w-full border rounded-lg p-2 @error('nombre_categoria') border-red-500 @enderror"
                           placeholder="Ej: Conciertos, Teatro, Danza, etc."
                           required>
                    @error('nombre_categoria')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción
                    </label>
                    <textarea id="descripcion" 
                              name="descripcion" 
                              rows="4"
                              class="w-full border rounded-lg p-2 @error('descripcion') border-red-500 @enderror"
                              placeholder="Descripción opcional de la categoría...">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Información adicional -->
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                    <p class="text-sm text-blue-700">
                        <strong>Nota:</strong> Las categorías con eventos asociados no podrán ser eliminadas.
                    </p>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('categorias.index') }}" 
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
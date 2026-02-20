<x-layouts.app :title="__('Crear Categoría')">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Nueva Categoría</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categorias.store') }}" class="space-y-4 max-w-2xl">
            @csrf

            <!-- Nombre de la categoría -->
            <div>
                <label for="nombre_categoria" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre de la Categoría *
                </label>
                <input type="text" 
                       id="nombre_categoria" 
                       name="nombre_categoria" 
                       value="{{ old('nombre_categoria') }}"
                       class="w-full border rounded p-2 @error('nombre_categoria') border-red-500 @enderror"
                       placeholder="Ej: Festival de Jazz, Exposición de Arte, etc."
                       required>
                @error('nombre_categoria')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo de categoría -->
            <div>
                <label for="tipo_categoria" class="block text-sm font-medium text-gray-700 mb-1">
                    Tipo de Categoría *
                </label>
                <select id="tipo_categoria" 
                        name="tipo_categoria" 
                        class="w-full border rounded p-2 @error('tipo_categoria') border-red-500 @enderror"
                        required>
                    <option value="">Selecciona un tipo</option>
                    <option value="Música" {{ old('tipo_categoria') == 'Música' ? 'selected' : '' }}>🎵 Música</option>
                    <option value="Danza" {{ old('tipo_categoria') == 'Danza' ? 'selected' : '' }}>💃 Danza</option>
                    <option value="Artes Plásticas" {{ old('tipo_categoria') == 'Artes Plásticas' ? 'selected' : '' }}>🎨 Artes Plásticas</option>
                    <option value="Audiovisuales" {{ old('tipo_categoria') == 'Audiovisuales' ? 'selected' : '' }}>🎬 Audiovisuales</option>
                    <option value="Teatro" {{ old('tipo_categoria') == 'Teatro' ? 'selected' : '' }}>🎭 Teatro</option>
                    <option value="Otro" {{ old('tipo_categoria') == 'Otro' ? 'selected' : '' }}>📌 Otro</option>
                </select>
                @error('tipo_categoria')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" 
                        class="bg-purple-600 text-black px-6 py-2 rounded hover:bg-purple-700 transition">
                    Guardar Categoría
                </button>
                
                <a href="{{ route('categorias.index') }}" 
                   class="bg-gray-500 text-black px-6 py-2 rounded hover:bg-gray-600 transition text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</x-layouts.app>
<x-layouts.app :title="__('Crear Ubicación')">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Nueva Ubicación</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('ubicaciones.store') }}" class="space-y-4 max-w-2xl">
            @csrf

            <!-- Dirección -->
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">
                    Dirección
                </label>
                <input type="text" 
                       id="direccion" 
                       name="direccion" 
                       value="{{ old('direccion') }}"
                       class="w-full border rounded p-2 @error('direccion') border-red-500 @enderror"
                       placeholder="Ej: Calle 50 # 45-20">
                @error('direccion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comuna -->
            <div>
                <label for="comuna" class="block text-sm font-medium text-gray-700 mb-1">
                    Comuna / Barrio
                </label>
                <input type="text" 
                       id="comuna" 
                       name="comuna" 
                       value="{{ old('comuna') }}"
                       class="w-full border rounded p-2 @error('comuna') border-red-500 @enderror"
                       placeholder="Ej: Laureles, El Poblado">
                @error('comuna')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo de lugar -->
            <div>
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">
                    Tipo de lugar
                </label>
                <select id="tipo" 
                        name="tipo" 
                        class="w-full border rounded p-2 @error('tipo') border-red-500 @enderror">
                    <option value="">Selecciona un tipo</option>
                    <option value="oficina" {{ old('tipo') == 'oficina' ? 'selected' : '' }}>Oficina</option>
                    <option value="bodega" {{ old('tipo') == 'bodega' ? 'selected' : '' }}>Bodega</option>
                    <option value="auditorio" {{ old('tipo') == 'auditorio' ? 'selected' : '' }}>Auditorio</option>
                    <option value="teatro" {{ old('tipo') == 'teatro' ? 'selected' : '' }}>Teatro</option>
                    <option value="aire_libre" {{ old('tipo') == 'aire_libre' ? 'selected' : '' }}>Aire libre</option>
                    <option value="otro" {{ old('tipo') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ciudad -->
            <div>
                <label for="ciudad" class="block text-sm font-medium text-gray-700 mb-1">
                    Ciudad
                </label>
                <input type="text" 
                       id="ciudad" 
                       name="ciudad" 
                       value="{{ old('ciudad', 'Medellin') }}"
                       class="w-full border rounded p-2 @error('ciudad') border-red-500 @enderror">
                @error('ciudad')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Departamento -->
            <div>
                <label for="departamento" class="block text-sm font-medium text-gray-700 mb-1">
                    Departamento
                </label>
                <input type="text" 
                       id="departamento" 
                       name="departamento" 
                       value="{{ old('departamento', 'Antioquia') }}"
                       class="w-full border rounded p-2 @error('departamento') border-red-500 @enderror">
                @error('departamento')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- País -->
            <div>
                <label for="pais" class="block text-sm font-medium text-gray-700 mb-1">
                    País
                </label>
                <input type="text" 
                       id="pais" 
                       name="pais" 
                       value="{{ old('pais', 'Colombia') }}"
                       class="w-full border rounded p-2 @error('pais') border-red-500 @enderror">
                @error('pais')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Observaciones -->
            <div>
                <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">
                    Observaciones
                </label>
                <textarea id="observaciones" 
                          name="observaciones" 
                          rows="3"
                          class="w-full border rounded p-2 @error('observaciones') border-red-500 @enderror"
                          placeholder="Información adicional...">{{ old('observaciones') }}</textarea>
                @error('observaciones')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Guardar Ubicación
                </button>
                
                <a href="{{ route('ubicaciones.index') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</x-layouts.app>
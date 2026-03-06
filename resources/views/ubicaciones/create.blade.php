<x-layouts.app :title="__('Crear Ubicación')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Crear Nueva Ubicación</h1>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('ubicaciones.store') }}" class="bg-white rounded-lg shadow p-6">
                @csrf

                <!-- Nombre del lugar -->
                <div class="mb-4">
                    <label for="nombre_lugar" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre del lugar *
                    </label>
                    <input type="text" 
                           id="nombre_lugar" 
                           name="nombre_lugar" 
                           value="{{ old('nombre_lugar') }}"
                           class="w-full border rounded-lg p-2 @error('nombre_lugar') border-red-500 @enderror"
                           placeholder="Ej: Teatro Metropolitano, Plaza Mayor, etc."
                           required>
                    @error('nombre_lugar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="mb-4">
                    <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">
                        Dirección *
                    </label>
                    <input type="text" 
                           id="direccion" 
                           name="direccion" 
                           value="{{ old('direccion') }}"
                           class="w-full border rounded-lg p-2 @error('direccion') border-red-500 @enderror"
                           placeholder="Ej: Calle 50 # 45-20"
                           required>
                    @error('direccion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Comuna y Tipo -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="comuna" class="block text-sm font-medium text-gray-700 mb-1">
                            Comuna / Barrio
                        </label>
                        <input type="text" 
                               id="comuna" 
                               name="comuna" 
                               value="{{ old('comuna') }}"
                               class="w-full border rounded-lg p-2 @error('comuna') border-red-500 @enderror"
                               placeholder="Ej: Laureles, El Poblado">
                        @error('comuna')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">
                            Tipo de lugar
                        </label>
                        <select id="tipo" 
                                name="tipo" 
                                class="w-full border rounded-lg p-2 @error('tipo') border-red-500 @enderror">
                            <option value="">Seleccione un tipo</option>
                            <option value="Teatro" {{ old('tipo') == 'Teatro' ? 'selected' : '' }}>Teatro</option>
                            <option value="Auditorio" {{ old('tipo') == 'Auditorio' ? 'selected' : '' }}>Auditorio</option>
                            <option value="Centro Cultural" {{ old('tipo') == 'Centro Cultural' ? 'selected' : '' }}>Centro Cultural</option>
                            <option value="Museo" {{ old('tipo') == 'Museo' ? 'selected' : '' }}>Museo</option>
                            <option value="Biblioteca" {{ old('tipo') == 'Biblioteca' ? 'selected' : '' }}>Biblioteca</option>
                            <option value="Parque" {{ old('tipo') == 'Parque' ? 'selected' : '' }}>Parque</option>
                            <option value="Otro" {{ old('tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('tipo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ciudad, Departamento, País -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="ciudad" class="block text-sm font-medium text-gray-700 mb-1">
                            Ciudad
                        </label>
                        <input type="text" 
                               id="ciudad" 
                               name="ciudad" 
                               value="{{ old('ciudad', 'Medellín') }}"
                               class="w-full border rounded-lg p-2 @error('ciudad') border-red-500 @enderror">
                        @error('ciudad')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="departamento" class="block text-sm font-medium text-gray-700 mb-1">
                            Departamento
                        </label>
                        <input type="text" 
                               id="departamento" 
                               name="departamento" 
                               value="{{ old('departamento', 'Antioquia') }}"
                               class="w-full border rounded-lg p-2 @error('departamento') border-red-500 @enderror">
                        @error('departamento')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pais" class="block text-sm font-medium text-gray-700 mb-1">
                            País
                        </label>
                        <input type="text" 
                               id="pais" 
                               name="pais" 
                               value="{{ old('pais', 'Colombia') }}"
                               class="w-full border rounded-lg p-2 @error('pais') border-red-500 @enderror">
                        @error('pais')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="mb-4">
                    <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">
                        Observaciones
                    </label>
                    <textarea id="observaciones" 
                              name="observaciones" 
                              rows="3"
                              class="w-full border rounded-lg p-2 @error('observaciones') border-red-500 @enderror"
                              placeholder="Información adicional sobre la ubicación...">{{ old('observaciones') }}</textarea>
                    @error('observaciones')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nota -->
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                    <p class="text-sm text-blue-700">
                        <strong>Nota:</strong> Las ubicaciones con eventos asociados no podrán ser eliminadas.
                    </p>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('ubicaciones.index') }}" 
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Guardar Ubicación
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
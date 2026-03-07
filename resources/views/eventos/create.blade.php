<x-layouts.app :title="__('Crear Evento')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Crear Nuevo Evento</h1>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('eventos.store') }}" class="bg-white rounded-lg shadow p-6">
                @csrf


                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Información del Evento</h2>

                <!-- Nombre del evento -->
                <div class="mb-4">
                    <label for="nombre_evento" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre del evento *
                    </label>
                    <input type="text" 
                           id="nombre_evento" 
                           name="nombre_evento" 
                           value="{{ old('nombre_evento') }}"
                           class="w-full border rounded-lg p-2 @error('nombre_evento') border-red-500 @enderror"
                           required>
                    @error('nombre_evento')
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
                              rows="3"
                              class="w-full border rounded-lg p-2 @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha y Hora -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha *
                        </label>
                        <input type="date" 
                               id="fecha" 
                               name="fecha" 
                               value="{{ old('fecha') }}"
                               class="w-full border rounded-lg p-2 @error('fecha') border-red-500 @enderror"
                               required>
                        @error('fecha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hora" class="block text-sm font-medium text-gray-700 mb-1">
                            Hora *
                        </label>
                        <input type="time" 
                               id="hora" 
                               name="hora" 
                               value="{{ old('hora') }}"
                               class="w-full border rounded-lg p-2 @error('hora') border-red-500 @enderror"
                               required>
                        @error('hora')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Categoría -->
                <div class="mb-6">
                    <label for="id_categoria" class="block text-sm font-medium text-gray-700 mb-1">
                        Categoría *
                    </label>
                    <select id="id_categoria" 
                            name="id_categoria" 
                            class="w-full border rounded-lg p-2 @error('id_categoria') border-red-500 @enderror"
                            required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" 
                                {{ old('id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_categoria')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Ubicación del Evento</h2>

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

                <!-- Comuna  -->
                <div class="mb-4">
                    <label for="comuna" class="block text-sm font-medium text-gray-700 mb-1">
                        Comuna *
                    </label>
                    <select id="comuna" 
                            name="comuna" 
                            class="w-full border rounded-lg p-2 @error('comuna') border-red-500 @enderror"
                            required>
                        <option value="">Seleccione una comuna</option>
                        <option value="1" {{ old('comuna') == '1' ? 'selected' : '' }}>Popular</option>
                        <option value="2" {{ old('comuna') == '2' ? 'selected' : '' }}>Santa Cruz</option>
                        <option value="3" {{ old('comuna') == '3' ? 'selected' : '' }}>Manrique</option>
                        <option value="4" {{ old('comuna') == '4' ? 'selected' : '' }}>Aranjuez</option>
                        <option value="5" {{ old('comuna') == '5' ? 'selected' : '' }}>Castilla</option>
                        <option value="6" {{ old('comuna') == '6' ? 'selected' : '' }}>Doce de Octubre</option>
                        <option value="7" {{ old('comuna') == '7' ? 'selected' : '' }}>Robledo</option>
                        <option value="8" {{ old('comuna') == '8' ? 'selected' : '' }}>Villa Hermosa</option>
                        <option value="9" {{ old('comuna') == '9' ? 'selected' : '' }}>Buenos Aires</option>
                        <option value="10" {{ old('comuna') == '10' ? 'selected' : '' }}>La Candelaria</option>
                        <option value="11" {{ old('comuna') == '11' ? 'selected' : '' }}>Laureles - Estadio</option>
                        <option value="12" {{ old('comuna') == '12' ? 'selected' : '' }}>La América</option>
                        <option value="13" {{ old('comuna') == '13' ? 'selected' : '' }}>San Javier</option>
                        <option value="14" {{ old('comuna') == '14' ? 'selected' : '' }}>El Poblado</option>
                        <option value="15" {{ old('comuna') == '15' ? 'selected' : '' }}>Guayabal</option>
                        <option value="16" {{ old('comuna') == '16' ? 'selected' : '' }}>Belén</option>
                        <option value="50" {{ old('comuna') == '50' ? 'selected' : '' }}>San Sebastián de Palmitas</option>
                        <option value="60" {{ old('comuna') == '60' ? 'selected' : '' }}>San Cristóbal</option>
                        <option value="70" {{ old('comuna') == '70' ? 'selected' : '' }}>Altavista</option>
                        <option value="80" {{ old('comuna') == '80' ? 'selected' : '' }}>San Antonio de Prado</option>
                        <option value="90" {{ old('comuna') == '90' ? 'selected' : '' }}>Santa Elena</option>
                    </select>
                    @error('comuna')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ciudad -->
                <div class="mb-4">
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

                <!-- Botones -->
                <div class="flex justify-center space-x-4 pt-4 border-t">
                    <a href="{{ route('eventos.index') }}" 
                       class="px-6 py-2 border rounded-lg text-black rounded-lg hover:bg-gray-700 transition text-center min-w-[150px]">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 border rounded-lg text-black rounded-lg hover:bg-blue-700 transition text-center min-w-[150px]">
                        Guardar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
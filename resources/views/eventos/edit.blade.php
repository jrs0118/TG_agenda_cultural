<x-layouts.app :title="__('Editar Evento')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Editar Evento: {{ $evento->nombre_evento }}</h1>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('eventos.update', $evento->id_evento) }}" class="bg-white rounded-lg shadow p-6">
                @csrf
                @method('PUT')

                <!-- Nombre del evento -->
                <div class="mb-4">
                    <label for="nombre_evento" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre del evento *
                    </label>
                    <input type="text" 
                           id="nombre_evento" 
                           name="nombre_evento" 
                           value="{{ old('nombre_evento', $evento->nombre_evento) }}"
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
                              rows="4"
                              class="w-full border rounded-lg p-2 @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $evento->descripcion) }}</textarea>
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
                               value="{{ old('fecha', $evento->fecha->format('Y-m-d')) }}"
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
                               value="{{ old('hora', \Carbon\Carbon::parse($evento->hora)->format('H:i')) }}"
                               class="w-full border rounded-lg p-2 @error('hora') border-red-500 @enderror"
                               required>
                        @error('hora')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Categoría y Ubicación -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
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
                                    {{ old('id_categoria', $evento->id_categoria) == $categoria->id_categoria ? 'selected' : '' }}>
                                    {{ $categoria->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_categoria')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_ubicacion" class="block text-sm font-medium text-gray-700 mb-1">
                            Ubicación *
                        </label>
                        <select id="id_ubicacion" 
                                name="id_ubicacion" 
                                class="w-full border rounded-lg p-2 @error('id_ubicacion') border-red-500 @enderror"
                                required>
                            <option value="">Seleccione una ubicación</option>
                            @foreach($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id_ubicacion }}"
                                    {{ old('id_ubicacion', $evento->id_ubicacion) == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                                    {{ $ubicacion->nombre_lugar }} - {{ $ubicacion->direccion }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_ubicacion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('eventos.index') }}" 
                       class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                        Actualizar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
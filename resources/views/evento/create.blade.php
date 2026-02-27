<x-layouts.app :title="__('Crear Evento')">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Crear Nuevo Evento</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('eventos.store') }}" class="space-y-4 max-w-2xl">
            @csrf

            <!-- Nombre del evento -->
            <div>
                <label for="nombre_evento" class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del evento *
                </label>
                <input type="text" 
                       id="nombre_evento" 
                       name="nombre_evento" 
                       value="{{ old('nombre_evento') }}"
                       class="w-full border rounded p-2 @error('nombre_evento') border-red-500 @enderror"
                       placeholder="Ej: Concierto de Rock, Exposición de Arte, etc."
                       required>
                @error('nombre_evento')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                    Descripción
                </label>
                <textarea id="descripcion" 
                          name="descripcion" 
                          rows="3"
                          class="w-full border rounded p-2 @error('descripcion') border-red-500 @enderror"
                          placeholder="Describe los detalles del evento...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha y Hora -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha *
                    </label>
                    <input type="date" 
                           id="fecha" 
                           name="fecha" 
                           value="{{ old('fecha') }}"
                           class="w-full border rounded p-2 @error('fecha') border-red-500 @enderror"
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
                           class="w-full border rounded p-2 @error('hora') border-red-500 @enderror"
                           required>
                    @error('hora')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Categoría (SELECT) -->
            <div>
                <label for="id_categoria" class="block text-sm font-medium text-gray-700 mb-1">
                    Categoría *
                </label>
                <select id="id_categoria"
                    name="id_categoria"
                    class="w-full border rounded p-2 @error('id_categoria') border-red-500 @enderror"
                    required>
                    <option value="">Selecciona una categoría</option>
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

            <!-- Ubicación CORREGIR 
            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700 mb-1">
                    Ubicación
                </label>

                <input 
                    type="text"
                    id="ubicacion"
                    name="ubicacion"
                    value="{{ old('ubicacion') }}"
                    class="w-full border rounded p-2 @error('ubicacion') border-red-500 @enderror"
                    placeholder="Escribe la ubicación del evento">

                @error('ubicacion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>-->

            <!-- Botones -->
            <div class="flex space-x-4 pt-4">
                <button type="submit" 
                        class="bg-blue-600 text-black px-6 py-2 rounded hover:bg-blue-700 transition">
                    Guardar Evento
                </button>
                
                <a href="{{ route('eventos.index') }}" 
                   class="bg-gray-500 text-black px-6 py-2 rounded hover:bg-gray-600 transition text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</x-layouts.app>
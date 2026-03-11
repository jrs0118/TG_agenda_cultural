<x-layouts.app :title="__('Ver Evento')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Detalles del Evento</h1>
                <div class="space-x-2">
                    <a href="{{ route('eventos.edit', $evento->id_evento) }}" 
                       class="border rounded-lg text-black px-4 py-2 rounded-lg hover:bg-yellow-700 transition inline-block">
                        Editar
                    </a>
                    <a href="{{ route('eventos.index') }}" 
                       class="border rounded-lg text-black px-4 py-2 rounded-lg hover:bg-gray-600 transition inline-block">
                        Volver
                    </a>
                </div>
    
            </div>

            <!-- Después del título, antes de los detalles -->
            @if($evento->imagen)
            <div class="mb-6">
                <img src="{{ Storage::url($evento->imagen) }}" 
                    alt="{{ $evento->nombre_evento }}" 
                    class="w-full max-h-96 object-cover rounded-lg shadow-lg">
            </div>
            @endif
            
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $evento->nombre_evento }}</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Fecha</h3>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Hora</h3>
                            <p class="text-lg">{{ \Carbon\Carbon::parse($evento->hora)->format('g:i A') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Categoría</h3>
                            <p class="text-lg">{{ $evento->categoria->nombre_categoria ?? 'No especificada' }}</p>
 
                        </div>
                    </div>

                    @if($evento->descripcion)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Descripción</h3>
                            <p class="text-gray-700">{{ $evento->descripcion }}</p>
                        </div>
                    @endif

                    <!-- Información de la ubicación -->
                    <div class="border-t pt-4 mt-4">
                        <h3 class="text-lg font-semibold mb-3">Ubicación</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Lugar</p>
                                <p class="font-medium">{{ $evento->ubicacion->nombre_lugar ?? 'No especificado' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Dirección</p>
                                <p>{{ $evento->ubicacion->direccion ?? 'No especificada' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Comuna</p>
                                <p>{{ $evento->ubicacion->comuna ?? 'No especificada' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Ciudad</p>
                                <p>{{ $evento->ubicacion->ciudad ?? 'Medellín' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4 mt-4 text-sm text-gray-500">
                        <p>Creado por: {{ $evento->usuario->name ?? 'Usuario desconocido' }}</p>
                        <p>Fecha de creación: {{ $evento->created_at->format('d/m/Y H:i') }}</p>
 
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
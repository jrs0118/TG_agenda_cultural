<x-layouts.app :title="__('Ver Evento')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Detalles del Evento</h1>
                <div class="space-x-2">
                    <a href="{{ route('eventos.edit', $evento->id_evento) }}" 
                       class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition inline-block">
                        Editar
                    </a>
                    <a href="{{ route('eventos.index') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition inline-block">
                        Volver
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
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
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Ubicación</h3>
                            <p class="text-lg">{{ $evento->ubicacion->nombre_lugar ?? 'No especificada' }}</p>
                            @if($evento->ubicacion)
                                <p class="text-sm text-gray-600">{{ $evento->ubicacion->direccion }}</p>
                                <p class="text-sm text-gray-600">{{ $evento->ubicacion->ciudad }}, {{ $evento->ubicacion->departamento }}</p>
                            @endif
                        </div>
                    </div>

                    @if($evento->descripcion)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Descripción</h3>
                            <p class="text-gray-700">{{ $evento->descripcion }}</p>
                        </div>
                    @endif

                    <div class="border-t pt-4 text-sm text-gray-500">
                        <p>Creado por: {{ $evento->usuario->name ?? 'Usuario desconocido' }}</p>
                        <p>Fecha de creación: {{ $evento->created_at->format('d/m/Y H:i') }}</p>
                        @if($evento->updated_at != $evento->created_at)
                            <p>Última actualización: {{ $evento->updated_at->format('d/m/Y H:i') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
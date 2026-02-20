<x-layouts.app :title="__('Eventos - Agenda Cultural')">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Eventos Culturales</h1>
            <a href="{{ route('eventos.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Nuevo Evento
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($eventos as $evento)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-neutral-200">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $evento->nombre_evento }}</h2>
                        <p class="text-gray-600 mb-3 line-clamp-2">{{ $evento->descripcion }}</p>
                        
                        <div class="space-y-2 text-sm">
                            <p><strong>Fecha:</strong> {{ $evento->fecha->format('d/m/Y') }}</p>
                            <p><strong>Hora:</strong> {{ $evento->hora }}</p>
                            <p><strong>Lugar:</strong> {{ $evento->ubicacion->nombre_lugar ?? 'No especificado' }}</p>
                            <p><strong>Categoría:</strong> {{ $evento->categoria->nombre_categoria ?? 'Sin categoría' }}</p>
                        </div>

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('eventos.show', $evento->id_evento) }}" 
                               class="text-blue-600 hover:text-blue-800">Ver</a>
                            <a href="{{ route('eventos.edit', $evento->id_evento) }}" 
                               class="text-yellow-600 hover:text-yellow-800">Editar</a>
                            <form method="POST" action="{{ route('eventos.destroy', $evento->id_evento) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" 
                                        onclick="return confirm('¿Eliminar evento?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">No hay eventos registrados</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $eventos->links() }}
        </div>
    </div>
</x-layouts.app>
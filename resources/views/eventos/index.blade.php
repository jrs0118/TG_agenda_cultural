<x-layouts.app :title="__('Eventos - Agenda Cultural')">

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Listado de Eventos</h1>
            <a href="{{ route('eventos.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                + Nuevo Evento
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabla de eventos -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ubicación</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Creado por</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($eventos as $evento)
                    <tr>
                        <td class="px-6 py-4">{{ $evento->id_evento }}</td>
                        <td class="px-6 py-4 font-medium">{{ $evento->nombre_evento }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($evento->hora)->format('g:i A') }}</td>
                        <td class="px-6 py-4">{{ $evento->categoria->nombre_categoria ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $evento->ubicacion->nombre_lugar ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $evento->usuario->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('eventos.show', $evento->id_evento) }}" 
                               class="text-blue-600 hover:text-blue-900">Ver</a>
                            <a href="{{ route('eventos.edit', $evento->id_evento) }}" 
                               class="text-yellow-600 hover:text-yellow-900">Editar</a>
                            <form action="{{ route('eventos.destroy', $evento->id_evento) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No hay eventos registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $eventos->links() }}
        </div>
    </div>

</x-layouts.app>
<x-layouts.app :title="__('Ubicaciones - Agenda Cultural')">

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Listado de Ubicaciones</h1>
            <a href="{{ route('ubicaciones.create') }}" 
               class="bg-blue-400 text-white rounded-lg hover:bg-blue-400 transition text-center min-w-[180px] font-medium shadow">
                + Nueva Ubicación
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

        <!-- Tabla de ubicaciones -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre del lugar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dirección</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Comuna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ciudad</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Eventos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($ubicaciones as $ubicacion)
                    <tr>
                        <td class="px-6 py-4">{{ $ubicacion->id_ubicacion }}</td>
                        <td class="px-6 py-4 font-medium">{{ $ubicacion->nombre_lugar }}</td>
                        <td class="px-6 py-4">{{ $ubicacion->direccion }}</td>
                        <td class="px-6 py-4">{{ $ubicacion->comuna ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $ubicacion->ciudad }}</td>
                        <td class="px-6 py-4">{{ $ubicacion->tipo ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                {{ $ubicacion->eventos_count ?? $ubicacion->eventos->count() }} eventos
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('ubicaciones.edit', $ubicacion->id_ubicacion) }}" 
                               class="inline-flex items-center px-4 py-2 border rounded-lg text-black rounded-lg hover:bg-blue-400 transition text-center min-w-[50px]">Editar</a>
                            <form action="{{ route('ubicaciones.destroy', $ubicacion->id_ubicacion) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border rounded-lg text-black rounded-lg hover:bg-blue-400 transition text-center min-w-[50px]"
                                        onclick="return confirm('¿Estás seguro de eliminar esta ubicación?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No hay ubicaciones registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-layouts.app>
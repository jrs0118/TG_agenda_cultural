<x-layouts.app :title="__('Ver Categoría')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Detalles de la Categoría</h1>
                <div class="space-x-2">
                    <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" 
                       class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition inline-block">
                        Editar
                    </a>
                    <a href="{{ route('categorias.index') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition inline-block">
                        Volver
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $categoria->nombre_categoria }}</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">ID</h3>
                            <p class="text-lg">{{ $categoria->id_categoria }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Total Eventos</h3>
                            <p class="text-lg">{{ $categoria->eventos->count() }} eventos</p>
                        </div>
                    </div>

                    @if($categoria->descripcion)
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Descripción</h3>
                            <p class="text-gray-700">{{ $categoria->descripcion }}</p>
                        </div>
                    @endif

                    <div class="border-t pt-4 text-sm text-gray-500">
                        <p>Creado: {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
                        <p>Última actualización: {{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Lista de eventos en esta categoría (opcional) -->
            @if($categoria->eventos->count() > 0)
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Eventos en esta categoría</h3>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ubicación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($categoria->eventos as $evento)
                            <tr>
                                <td class="px-6 py-4">
                                    <a href="{{ route('eventos.show', $evento->id_evento) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        {{ $evento->nombre_evento }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">{{ $evento->fecha->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $evento->ubicacion->nombre_lugar ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

</x-layouts.app>
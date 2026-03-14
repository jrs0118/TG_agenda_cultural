<x-layouts.app :title="__('Eventos - Agenda Cultural')">

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Listado de Eventos</h1>
      
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

        <!-- Eventos -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th> <!-- NUEVA COLUMNA -->
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
                        
                        <!-- Columna de imagen -->
                        <td class="px-6 py-4">
                            @if($evento->imagen)
                                <img src="{{ Storage::url($evento->imagen) }}" 
                                     alt="{{ $evento->nombre_evento }}"
                                     class="w-16 h-16 object-cover rounded-lg shadow-sm">
                            @else
                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                </div>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4 font-medium">{{ $evento->nombre_evento }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($evento->hora)->format('g:i A') }}</td>
                        <td class="px-6 py-4">{{ $evento->categoria->nombre_categoria ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $evento->ubicacion->nombre_lugar ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $evento->usuario->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            <!-- Botón Ver -->
                            <a href="{{ route('eventos.show', $evento->id_evento) }}" 
                            class="inline-flex items-center px-4 py-2 border rounded-lg text-black rounded-lg hover:bg-blue-400 transition text-center min-w-[50px]">
                                <i class="fas fa-eye mr-2"></i>
                                Ver
                            </a>
                            
                            <!-- Botón Editar -->
                            <a href="{{ route('eventos.edit', $evento->id_evento) }}" 
                            class="inline-flex items-center px-4 py-2 border rounded-lg text-black rounded-lg hover:bg-blue-400 transition text-center min-w-[50px]">
                                <i class="fas fa-edit mr-2"></i>
                                Editar
                            </a>
                            
                            <!-- Botón Eliminar -->
                            <form action="{{ route('eventos.destroy', $evento->id_evento) }}" 
                                method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2  border rounded-lg text-black rounded-lg hover:bg-blue-400 transition text-center min-w-[50px]"
                                        onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                            No hay eventos registrados
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            {{ $eventos->links() }}
        </div>

        <!-- botones-->
        <div class="flex justify-center space-x-4 mt-8">
            <a href="{{ route('dashboard') }}" 
               class="px-6 py-3 bg-blue-400 text-white rounded-lg hover:bg-blue-400 transition text-center min-w-[180px] font-medium shadow">
                Volver al Dashboard
            </a>
            
            <a href="{{ route('categorias.create') }}" 
               class="px-6 py-3 bg-blue-400 text-white rounded-lg hover:bg-blue-400 transition text-center min-w-[180px] font-medium shadow">
                Nueva Categoría
            </a>
            
            <a href="{{ route('eventos.create') }}" 
               class="px-6 py-3 bg-blue-400 text-white rounded-lg hover:bg-blue-400 transition text-center min-w-[180px] font-medium shadow">
                Nuevo Evento
            </a>
        </div>
    </div>

</x-layouts.app>
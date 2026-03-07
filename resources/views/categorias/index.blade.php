<x-layouts.app :title="__('Categorías - Agenda Cultural')">

    <div class="container mx-auto px-4 py-8">
        <!-- Título -->
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Listado de Categorías</h1>

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

        <!-- Tabla de categorías -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Eventos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categorias as $categoria)
                    <tr>
                        <td class="px-6 py-4">{{ $categoria->id_categoria }}</td>
                        <td class="px-6 py-4 font-medium">{{ $categoria->nombre_categoria }}</td>
                        <td class="px-6 py-4">{{ $categoria->descripcion ?? 'Sin descripción' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                {{ $categoria->eventos->count() }} eventos
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $categoria->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" 
                               class="text-yellow-600 hover:text-yellow-900 mr-3">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No hay categorías registradas
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TRES BOTONES INFERIORES - CON BORDES Y COLORES SÓLIDOS -->
        <div class="flex justify-center space-x-4 mt-6">
            <!-- Botón 1: Volver al Dashboard (GRIS OSCURO) -->
            <a href="{{ route('dashboard') }}" 
               class="inline-block px-6 py-3 bg-gray-700 text-black font-bold rounded-lg hover:bg-gray-800 transition text-center min-w-[170px] border-2 border-gray-800 shadow-lg">
                VOLVER AL DASHBOARD
            </a>
            
            <!-- Botón 2: Nueva Categoría (MORADO BRILLANTE) -->
            <a href="{{ route('categorias.create') }}" 
               class="inline-block px-6 py-3 bg-purple-700 text-black font-bold rounded-lg hover:bg-purple-800 transition text-center min-w-[170px] border-2 border-purple-900 shadow-lg">
                 NUEVA CATEGORÍA
            </a>
            
            <!-- Botón 3: Nuevo Evento (AZUL BRILLANTE) -->
            <a href="{{ route('eventos.create') }}" 
               class="inline-block px-6 py-3 bg-blue-700 text-black font-bold rounded-lg hover:bg-blue-800 transition text-center min-w-[170px] border-2 border-blue-900 shadow-lg">
                 NUEVO EVENTO
            </a>
        </div>
        
        
    </div>

</x-layouts.app>
<x-layouts.app :title="__('Gestión de Usuarios - Seguridad')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-users text-[#0033A0] mr-2"></i>
                        Gestión de Usuarios
                    </h1>
                    <p class="text-gray-600 mt-1">Administra los gestores culturales del sistema</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('seguridad.create') }}" 
                       class="bg-[#0033A0] text-white px-4 py-2 rounded-lg hover:bg-[#002070] transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Nuevo Gestor
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#0033A0]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha Registro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($usuarios as $usuario)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $usuario->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $usuario->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($usuario->rol && $usuario->rol->nombre_rol == 'Administrador') bg-red-100 text-red-800
                                    @elseif($usuario->rol && $usuario->rol->nombre_rol == 'Gestor Cultural') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $usuario->rol->nombre_rol ?? 'Sin rol' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <i class="fas fa-calendar-alt text-gray-400 mr-1"></i>
                                {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('seguridad.edit', $usuario->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1" 
                                       title="Editar usuario">
                                        <i class="fas fa-edit"></i>
                                        <span class="text-xs hidden md:inline">Editar</span>
                                    </a>
                                    
                                    <!-- Botón Eliminar (excepto el propio usuario) -->
                                    @if($usuario->id !== Auth::id())
                                    <form action="{{ route('seguridad.destroy', $usuario->id) }}" 
                                          method="POST" class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800 transition flex items-center gap-1" 
                                                title="Eliminar usuario">
                                            <i class="fas fa-trash-alt"></i>
                                            <span class="text-xs hidden md:inline">Eliminar</span>
                                        </button>
                                    </form>
                                    @else
                                        <span class="text-gray-400 text-xs" title="No puedes eliminarte a ti mismo">
                                            <i class="fas fa-trash-alt"></i>
                                            <span class="text-xs hidden md:inline">No disponible</span>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-users fa-3x mb-3 opacity-50"></i>
                                <p class="text-lg">No hay usuarios registrados</p>
                                <p class="text-sm mt-1">Comienza creando el primer gestor cultural</p>
                                <a href="{{ route('seguridad.create') }}" class="text-[#0033A0] hover:underline mt-3 inline-block">
                                    <i class="fas fa-plus mr-1"></i> Crear nuevo gestor →
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($usuarios->hasPages())
            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
            @endif
        </div>
    </div>

</x-layouts.app>
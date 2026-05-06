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
                       class="bg-[#0033A0] text-white px-4 py-2 rounded-lg hover:bg-[#002070] transition">
                        <i class="fas fa-plus mr-2"></i>Nuevo Gestor
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Volver
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#0033A0]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Fecha Registro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($usuarios as $usuario)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">{{ $usuario->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium">{{ $usuario->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                    {{ $usuario->rol->nombre_rol ?? 'Sin rol' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $usuario->created_at?->format('d/m/Y') ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('seguridad.edit', $usuario->id) }}" 
                                       class="text-blue-600 hover:text-blue-800" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($usuario->id !== Auth::id())
                                    <form action="{{ route('seguridad.destroy', $usuario->id) }}" 
                                          method="POST" class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-users fa-3x mb-2 opacity-50"></i>
                                <p>No hay usuarios registrados</p>
                                <a href="{{ route('seguridad.create') }}" class="text-[#0033A0] hover:underline mt-2 inline-block">
                                    Crear el primer gestor cultural →
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>

</x-layouts.app>
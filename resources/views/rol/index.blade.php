<x-layouts.app :title="__('Gestión de Roles')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-key text-[#0033A0] mr-2"></i>
                        Gestión de Roles
                    </h1>
                    <p class="text-gray-600 mt-1">Administra los roles y permisos del sistema</p>
                </div>
                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#0033A0]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase">Permisos</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($roles as $rol)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">{{ $rol->id_rol }}</td>
                            <td class="px-6 py-4 text-sm font-medium">{{ $rol->nombre_rol }}</td>
                            <td class="px-6 py-4 text-sm">{{ $rol->descripcion ?? 'Sin descripción' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                    {{ $rol->permisos->count() }} permisos
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No hay roles registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.app>
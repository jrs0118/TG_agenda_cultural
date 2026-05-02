<x-layouts.app :title="__('Historial de Reportes - Agenda Cultural')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">📜 Historial de Reportes</h1>
                    <p class="text-gray-600 mt-1">Reportes generados anteriormente</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('reportes.index') }}" 
                       class="bg-[#0033A0] text-white px-4 py-2 rounded-lg hover:bg-[#002070] transition flex items-center gap-2">
                        <i class="fas fa-plus"></i> Nuevo Reporte
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Volver
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Generado por</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reportes as $reporte)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $reporte->id_reporte }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($reporte->tipo_reporte == 'listado')
                                        <i class="fas fa-list text-blue-500"></i>
                                    @else
                                        <i class="fas fa-chart-bar text-green-500"></i>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900">{{ $reporte->nombre_reporte }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($reporte->tipo_reporte == 'listado') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($reporte->tipo_reporte) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $reporte->usuario->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($reporte->fecha_generacion)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('reportes.descargar', $reporte->id_reporte) }}" 
                                       class="text-green-600 hover:text-green-800 transition" title="Descargar">
                                        <i class="fas fa-download text-lg"></i>
                                    </a>
                                    <form action="{{ route('reportes.eliminar', $reporte->id_reporte) }}" 
                                          method="POST" class="inline"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este reporte?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Eliminar">
                                            <i class="fas fa-trash-alt text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-file-excel text-5xl mb-3 opacity-50"></i>
                                <p>No hay reportes generados todavía</p>
                                <a href="{{ route('reportes.index') }}" class="text-[#0033A0] hover:underline mt-2 inline-block">
                                    Generar primer reporte →
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reportes->links() }}
            </div>
        </div>
    </div>

</x-layouts.app>
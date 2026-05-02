<x-layouts.app :title="__('Reportes - Agenda Cultural')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Encabezado -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">📊 Módulo de Reportes</h1>
                    <p class="text-gray-600 mt-1">Genera reportes en Excel con información de eventos culturales</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('reportes.historial') }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition flex items-center gap-2">
                        <i class="fas fa-history"></i>
                        Historial
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Total Eventos</p>
                            <p class="text-3xl font-bold">{{ $totalEventos }}</p>
                        </div>
                        <i class="fas fa-calendar-alt text-4xl opacity-50"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Eventos Futuros</p>
                            <p class="text-3xl font-bold">{{ $eventosFuturos }}</p>
                        </div>
                        <i class="fas fa-calendar-check text-4xl opacity-50"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Eventos Realizados</p>
                            <p class="text-3xl font-bold">{{ $eventosPasados }}</p>
                        </div>
                        <i class="fas fa-calendar-times text-4xl opacity-50"></i>
                    </div>
                </div>
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Este Mes</p>
                            <p class="text-3xl font-bold">{{ $eventosEsteMes }}</p>
                        </div>
                        <i class="fas fa-chart-line text-4xl opacity-50"></i>
                    </div>
                </div>
            </div>

            <!-- Reporte 1: Listado de Eventos -->
            <div class="bg-white rounded-xl shadow-lg mb-8 overflow-hidden">
                <div class="bg-[#0033A0] px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Reporte Listado de Eventos</h2>
                            <p class="text-white text-sm opacity-90">Exporta todos los eventos con filtros personalizables</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('reportes.generar.listado') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        <input type="hidden" name="tipo_reporte" value="listado">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-tag text-[#0033A0] mr-1"></i>
                                Categoría
                            </label>
                            <select name="categoria" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                                <option value="">Todas las categorías</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-map-marker-alt text-[#0033A0] mr-1"></i>
                                Ubicación
                            </label>
                            <select name="ubicacion" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                                <option value="">Todas las ubicaciones</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id_ubicacion }}">{{ $ubicacion->nombre_lugar }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-building text-[#0033A0] mr-1"></i>
                                Comuna
                            </label>
                            <select name="comuna" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                                <option value="">Todas las comunas</option>
                                @foreach($comunas as $key => $nombre)
                                    <option value="{{ $key }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-calendar-alt text-[#0033A0] mr-1"></i>
                                Fecha desde
                            </label>
                            <input type="date" name="fecha_desde" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-calendar-alt text-[#0033A0] mr-1"></i>
                                Fecha hasta
                            </label>
                            <input type="date" name="fecha_hasta" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                        </div>
                        
                        <div class="flex items-end">
                            <button type="submit" 
                                    class="w-full bg-[#0033A0] text-white px-6 py-2.5 rounded-lg hover:bg-[#002070] transition flex items-center justify-center gap-2">
                                <i class="fas fa-file-excel"></i>
                                Generar Listado
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Reporte 2: Resumen Ejecutivo -->
            <div class="bg-white rounded-xl shadow-lg mb-8 overflow-hidden">
                <div class="bg-[#0033A0] px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-pie text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Reporte Resumen Ejecutivo</h2>
                            <p class="text-white text-sm opacity-90">Estadísticas y métricas clave</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('reportes.generar.resumen') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <input type="hidden" name="tipo_reporte" value="resumen">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-calendar-alt text-[#0033A0] mr-1"></i>
                                Fecha desde
                            </label>
                            <input type="date" name="fecha_desde" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-calendar-alt text-[#0033A0] mr-1"></i>
                                Fecha hasta
                            </label>
                            <input type="date" name="fecha_hasta" class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-[#0033A0]">
                        </div>
                        
                        <div class="md:col-span-2">
                            <button type="submit" 
                                    class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center justify-center gap-2">
                                <i class="fas fa-chart-pie"></i>
                                Generar Reporte Resumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
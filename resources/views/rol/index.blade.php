<x-layouts.app :title="__('Gestión de Roles')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-key text-[#0033A0] mr-2"></i>
                        Gestión de Roles
                    </h1>
                    <p class="text-gray-600 mt-1">Visualiza los roles y los permisos asignados a cada uno</p>
                </div>
                <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tarjetas de roles -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Tarjeta: Administrador -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="bg-blue-600 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-bold text-white">
                                    <i class="fas fa-crown mr-2"></i>
                                    Administrador
                                </h2>
                                <p class="text-blue-100 text-sm mt-1">Control total del sistema</p>
                            </div>
                            <div class="bg-white/20 rounded-lg px-3 py-1">
                                <span class="text-white font-bold">18</span>
                                <span class="text-blue-100 text-xs"> permisos</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-calendar-alt text-[#0033A0]"></i>
                                    Eventos
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver eventos</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Crear eventos</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Editar eventos</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Eliminar eventos</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-tags text-[#0033A0]"></i>
                                    Categorías
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver categorías</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Crear categorías</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Editar categorías</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Eliminar categorías</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-map-marker-alt text-[#0033A0]"></i>
                                    Ubicaciones
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver ubicaciones</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Crear ubicaciones</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Editar ubicaciones</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Eliminar ubicaciones</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-chart-bar text-[#0033A0]"></i>
                                    Reportes
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver reportes</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Generar reportes</li>
                                </ul>
                            </div>
                            <div class="md:col-span-2">
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-users text-[#0033A0]"></i>
                                    Usuarios
                                </h3>
                                <ul class="grid grid-cols-2 gap-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver usuarios</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Crear usuarios</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Editar usuarios</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Eliminar usuarios</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta: Gestor Cultural -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <div class="bg-green-600 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-bold text-white">
                                    <i class="fas fa-user-tie mr-2"></i>
                                    Gestor Cultural
                                </h2>
                                <p class="text-green-100 text-sm mt-1">Gestión de eventos y consulta de información</p>
                            </div>
                            <div class="bg-white/20 rounded-lg px-3 py-1">
                                <span class="text-white font-bold">8</span>
                                <span class="text-green-100 text-xs"> permisos</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-calendar-alt text-[#0033A0]"></i>
                                    Eventos
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver eventos</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Crear eventos</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Editar eventos</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Eliminar eventos</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-tags text-[#0033A0]"></i>
                                    Categorías
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver categorías</li>
                                    <li class="flex items-center gap-2 text-gray-400"><i class="fas fa-times-circle text-xs"></i> Crear categorías</li>
                                    <li class="flex items-center gap-2 text-gray-400"><i class="fas fa-times-circle text-xs"></i> Editar categorías</li>
                                    <li class="flex items-center gap-2 text-gray-400"><i class="fas fa-times-circle text-xs"></i> Eliminar categorías</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-map-marker-alt text-[#0033A0]"></i>
                                    Ubicaciones
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver ubicaciones</li>
                                    <li class="flex items-center gap-2 text-gray-400"><i class="fas fa-times-circle text-xs"></i> Crear ubicaciones</li>
                                    <li class="flex items-center gap-2 text-gray-400"><i class="fas fa-times-circle text-xs"></i> Editar ubicaciones</li>
                                    <li class="flex items-center gap-2 text-gray-400"><i class="fas fa-times-circle text-xs"></i> Eliminar ubicaciones</li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2 border-b pb-2">
                                    <i class="fas fa-chart-bar text-[#0033A0]"></i>
                                    Reportes
                                </h3>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Ver reportes</li>
                                    <li class="flex items-center gap-2 text-green-600"><i class="fas fa-check-circle text-xs"></i> Generar reportes</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
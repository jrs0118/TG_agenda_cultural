<x-layouts.app :title="__('Panel de Administración - Agenda Cultural')">

    <div class="min-h-screen bg-gray-100">
        <!-- Header superior con perfil y navegación -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo y título con ícono -->
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-calendar-alt text-2xl text-[#0033A0]"></i>
                        <h1 class="text-xl font-bold text-gray-900">Agenda Cultural - Administración</h1>
                    </div>

                    <!-- Perfil de usuario con menú desplegable -->
                    <div class="flex items-center gap-4">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 focus:outline-none">
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Bienvenido,</p>
                                    <p class="font-semibold">{{ Auth::user()->name ?? 'Usuario' }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </button>
                            
                            <!-- Menú desplegable -->
                            <div x-show="open" 
                                @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50"
                                x-cloak>
                                <div class="py-1">
                                    <a href="{{ route('configuracion.index') }}" 
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                        <i class="fas fa-user-circle w-5 text-[#0033A0]"></i>
                                        <span class="ml-2">Mi Perfil</span>
                                    </a>
                                    <div class="border-t border-gray-200 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition">
                                            <i class="fas fa-sign-out-alt w-5"></i>
                                            <span class="ml-2">Cerrar sesión</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Enlace al sitio público -->
                        <a href="{{ route('home') }}" 
                        class="text-gray-400 hover:text-blue-600 transition p-2"
                        title="Ver sitio web">
                            <i class="fas fa-external-link-alt text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header de bienvenida -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Panel de Administración</h1>
            </div>

            <!-- Estadísticas de los módulos principales -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Eventos -->
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Eventos</p>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Evento::count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📅</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Categorías</p>
                            <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Categoria::count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">🏷️</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Ubicaciones</p>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Ubicacion::count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📍</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Reportes Generados</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Reporte::count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <span class="text-2xl">📊</span>
                        </div>
                    </div>
                </div>
             

            </div>

            <!-- Tarjetas de módulos principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- M01 - Gestión de Eventos -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-blue-600 p-4">
                        <h2 class="text-xl font-bold text-white">📅 Gestión de Eventos</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Crear, modificar y eliminar eventos culturales</p>
                        <a href="{{ route('eventos.create') }}" 
                           class="block w-full bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition text-sm">
                            <i class="fas fa-plus-circle mr-1"></i>Crear Evento
                        </a>
                    </div>
                </div>

                <!-- M02 - Gestión de Categorías -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-purple-600 p-4">
                        <h2 class="text-xl font-bold text-white">🏷️ Gestión de Categorías</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Clasificación de eventos por enfoque artístico</p>
                        <a href="{{ route('categorias.create') }}" 
                           class="block w-full bg-purple-600 text-white text-center py-2 rounded hover:bg-purple-700 transition text-sm">
                            <i class="fas fa-plus-circle mr-1"></i>Crear Categoría
                        </a>
                    </div>
                </div>

                <!-- M03 - Gestión de Ubicaciones -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-green-600 p-4">
                        <h2 class="text-xl font-bold text-white">📍 Gestión de Ubicaciones</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Visualizar ubicaciones de eventos (se crean automáticamente)</p>
                        <a href="{{ route('ubicaciones.index') }}" 
                           class="block w-full bg-green-600 text-white text-center py-2 rounded hover:bg-green-700 transition text-sm">
                            <i class="fas fa-list mr-1"></i>Ver todas las ubicaciones
                        </a>
                    </div>
                </div>

                <!-- M05 - Reportes -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-yellow-600 p-4">
                        <h2 class="text-xl font-bold text-white">📊 Módulo Reportes</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Genera reportes en Excel con estadísticas y listados de eventos</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('reportes.index') }}" 
                               class="flex-1 bg-yellow-600 text-white text-center py-2 rounded hover:bg-yellow-700 transition text-sm">
                                <i class="fas fa-chart-bar mr-1"></i>Generar
                            </a>
                            <a href="{{ route('reportes.historial') }}" 
                               class="flex-1 bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition text-sm">
                                <i class="fas fa-history mr-1"></i>Historial
                            </a>
                        </div>
                    </div>
                </div>

                <!-- M07 - Configuración General -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-gray-600 p-4">
                        <h2 class="text-xl font-bold text-white">⚙️ Configuración General</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Configura tu perfil y preferencias</p>
                        <a href="{{ route('configuracion.index') }}" 
                           class="block w-full bg-gray-600 text-white text-center py-2 rounded hover:bg-gray-700 transition text-sm">
                            <i class="fas fa-user-circle mr-1"></i>Mi Perfil
                        </a>
                    </div>
                </div>

                <!-- M08 - Seguridad -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-red-600 p-4">
                        <h2 class="text-xl font-bold text-white">🔒 Módulo Seguridad</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Gestión de usuarios y roles del sistema</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('seguridad.index') }}" 
                               class="flex-1 bg-red-600 text-white text-center py-2 rounded hover:bg-red-700 transition text-sm">
                                <i class="fas fa-users mr-1"></i>Usuarios
                            </a>
                            <a href="{{ route('rol.index') }}" 
                               class="flex-1 bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition text-sm">
                                <i class="fas fa-key mr-1"></i>Roles
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nota informativa -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Nota:</strong> Las ubicaciones se crean automáticamente al crear un evento. 
                            Por eso solo está disponible la opción de listar y visualizar.
                        </p>
                    </div>
                </div>
            </div>

        </main>
    </div>

</x-layouts.app>
<x-layouts.app :title="__('Panel de Administración - Agenda Cultural')">

    <div class="min-h-screen bg-gray-100">
        <!-- Header superior con perfil y navegación -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <!-- Logo y título -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-[#0033A0] rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-white"></i>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900">Agenda Cultural - Administración</h1>
                    </div>

                    <!-- Perfil de usuario en la parte superior -->
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Bienvenido,</p>
                            <p class="font-semibold">{{ Auth::user()->name ?? 'Usuario' }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</p>
                        </div>
                        
                        <!-- Botón cerrar sesión -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition"
                                    title="Cerrar sesión">
                                <i class="fas fa-sign-out-alt text-xl"></i>
                            </button>
                        </form>
                        
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
                <p class="text-gray-600 mt-1">Gestiona los módulos del sistema</p>
            </div>

            <!-- Estadísticas de los módulos principales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- M01 - Eventos -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-600">Total Eventos</p>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Evento::count() }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- M02 - Categorías -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition border-l-4 border-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-600">Total Categorías</p>
                            <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Categoria::count() }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-tags text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- M03 - Ubicaciones (solo estadística) -->
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition border-l-4 border-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-600">Total Ubicaciones</p>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Ubicacion::count() }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-map-marked-alt text-green-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de módulos principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- M01 - Gestión de Eventos -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-blue-600 p-4">
                        <h2 class="text-xl font-bold text-white">Módulo Gestión de Eventos</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Crear, modificar y eliminar eventos culturales</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('eventos.create') }}" 
                               class="flex-1 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition text-sm">
                                <i class="fas fa-plus-circle mr-1"></i>Crear
                            </a>
                            <a href="{{ route('eventos.index') }}" 
                               class="flex-1 bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition text-sm">
                                <i class="fas fa-list mr-1"></i>Listar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- M02 - Gestión de Categorías -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-purple-600 p-4">
                        <h2 class="text-xl font-bold text-white">Módulo Gestión de Categorías</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Clasificación de eventos por enfoque artístico</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('categorias.create') }}" 
                               class="flex-1 bg-purple-600 text-white text-center py-2 rounded hover:bg-purple-700 transition text-sm">
                                <i class="fas fa-plus-circle mr-1"></i>Crear
                            </a>
                            <a href="{{ route('categorias.index') }}" 
                               class="flex-1 bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition text-sm">
                                <i class="fas fa-list mr-1"></i>Listar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- M03 - Gestión de Ubicaciones (SOLO LISTAR) -->
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="bg-green-600 p-4">
                        <h2 class="text-xl font-bold text-white">Módulo Gestión de Ubicaciones</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Visualizar ubicaciones de eventos (se crean automáticamente)</p>
                        <div class="flex space-x-2">
                            <a href="{{ route('ubicaciones.index') }}" 
                               class="w-full bg-green-600 text-white text-center py-2 rounded hover:bg-green-700 transition text-sm">
                                <i class="fas fa-list mr-1"></i>Ver todas las ubicaciones
                            </a>
                        </div>
                        <p class="text-xs text-gray-400 mt-2 text-center">
                            <i class="fas fa-info-circle"></i> Las ubicaciones se crean al crear un evento
                        </p>
                    </div>
                </div>

                <!-- M05 - Reportes (placeholder) -->
                <div class="bg-white rounded-lg shadow overflow-hidden opacity-75">
                    <div class="bg-yellow-600 p-4">
                        <h2 class="text-xl font-bold text-white">Módulo Reportes</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Informes y estadísticas de eventos (próximamente)</p>
                        <button disabled class="w-full bg-gray-400 text-white py-2 rounded cursor-not-allowed text-sm">
                            <i class="fas fa-clock mr-1"></i>PENDIENTE
                        </button>
                    </div>
                </div>

                <!-- M07 - Configuración General (placeholder) -->
                <div class="bg-white rounded-lg shadow overflow-hidden opacity-75">
                    <div class="bg-gray-600 p-4">
                        <h2 class="text-xl font-bold text-white">Módulo Configuración General</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Ajustes del sistema (próximamente)</p>
                        <button disabled class="w-full bg-gray-400 text-white py-2 rounded cursor-not-allowed text-sm">
                            <i class="fas fa-clock mr-1"></i>PENDIENTE
                        </button>
                    </div>
                </div>

                <!-- M08 - Seguridad (placeholder) -->
                <div class="bg-white rounded-lg shadow overflow-hidden opacity-75">
                    <div class="bg-red-600 p-4">
                        <h2 class="text-xl font-bold text-white">Módulo Seguridad</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Usuarios, Roles y Permisos (próximamente)</p>
                        <button disabled class="w-full bg-gray-400 text-white py-2 rounded cursor-not-allowed text-sm">
                            <i class="fas fa-clock mr-1"></i>PENDIENTE
                        </button>
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
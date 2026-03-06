<x-layouts.app :title="__('Panel de Administración - Agenda Cultural')">

    <div class="flex min-h-screen bg-gray-100">
        <!-- SIDEBAR - Panel izquierdo -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Menú Admin</h2>
                
                <!-- Perfil del usuario -->
                <div class="mb-8 pb-4 border-b">
                    <p class="text-sm text-gray-600">Bienvenido,</p>
                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>

                <!-- ACCIONES RÁPIDAS - Panel izquierdo -->
                <div class="space-y-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Acciones rápidas</h3>
                    
                    <a href="{{ route('eventos.create') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition group">
                        <span>Crear nuevo evento</span>
                    </a>
                    
                    <a href="{{ route('categorias.create') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition group">
                        <span>Crear nueva categoría</span>
                    </a>
                    
                    <a href="{{ route('ubicaciones.create') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition group">
                        <span>Crear nueva ubicación</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- CONTENIDO PRINCIPAL - Área derecha -->
        <main class="flex-1 p-8">
            <!-- Header del dashboard -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Panel de Administración</h1>
                <p class="text-gray-600 mt-1">Gestiona los eventos, categorías y ubicaciones de la agenda cultural</p>
            </div>

            <!-- Resumen / Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-600">Total Eventos</p>
                    <p class="text-2xl font-bold">{{ \App\Models\Evento::count() }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                    <p class="text-sm text-gray-600">Categorías</p>
                    <p class="text-2xl font-bold">{{ \App\Models\Categoria::count() }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-600">Ubicaciones</p>
                    <p class="text-2xl font-bold">{{ \App\Models\Ubicacion::count() }}</p>
                </div>
            </div>

            <!-- Módulos de Gestión (Tarjetas principales) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Módulo Eventos -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-blue-600 p-4">
                        <h2 class="text-xl font-bold text-white">Gestión de Eventos</h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <p class="text-gray-600 text-sm">Administra los eventos culturales (Crear, Leer, Actualizar, Eliminar)</p>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('eventos.create') }}" 
                               class="bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition">
                                + Nuevo
                            </a>
                            <a href="{{ route('eventos.index') }}" 
                               class="bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition">
                                Listar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo Categorías -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-purple-600 p-4">
                        <h2 class="text-xl font-bold text-white">Gestión de Categorías</h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <p class="text-gray-600 text-sm">Administra las categorías para clasificar los eventos</p>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('categorias.create') }}" 
                               class="bg-purple-600 text-white text-center py-2 rounded hover:bg-purple-700 transition">
                                + Nueva
                            </a>
                            <a href="{{ route('categorias.index') }}" 
                               class="bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition">
                                Listar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Módulo Ubicaciones -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-green-600 p-4">
                        <h2 class="text-xl font-bold text-white">Gestión de Ubicaciones</h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <p class="text-gray-600 text-sm">Administra los lugares donde se realizan los eventos</p>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('ubicaciones.create') }}" 
                               class="bg-green-600 text-white text-center py-2 rounded hover:bg-green-700 transition">
                                + Nueva
                            </a>
                            <a href="{{ route('ubicaciones.index') }}" 
                               class="bg-gray-200 text-gray-700 text-center py-2 rounded hover:bg-gray-300 transition">
                                Listar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</x-layouts.app>
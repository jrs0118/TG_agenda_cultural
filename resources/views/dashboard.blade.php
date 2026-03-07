<x-layouts.app :title="__('Panel de Administración - Agenda Cultural')">

    <div class="flex min-h-screen bg-gray-100">
        <!-- Panel izquierdo-->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Menú Admin</h2>
                
                
                <div class="mb-8 pb-4 border-b">
                    <p class="text-sm text-gray-600">Bienvenido,</p>
                    <p class="font-semibold">{{ Auth::user()->name ?? 'Usuario' }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email ?? '' }}</p>
                </div>

                <!-- acciones rápidas -->
                <div class="space-y-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Acciones rápidas</h3>
                    
                    <a href="{{ route('eventos.create') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition">
                        <span class="w-8 text-center"></span>
                        <span>Crear nuevo evento</span>
                    </a>
                    
                    <a href="{{ route('categorias.create') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition">
                        <span class="w-8 text-center"></span>
                        <span>Crear nueva categoría</span>
                    </a>
                </div>

                <!-- Principal -->
                <div class="mt-8 pt-4 border-t space-y-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Navegación</h3>
                    
                  
                    <a href="{{ route('eventos.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition {{ request()->routeIs('eventos.*') ? 'bg-blue-50 text-blue-700 font-semibold' : '' }}">
                        <span class="w-8 text-center"></span>
                        <span>Eventos</span>
                    </a>
                    
                    <a href="{{ route('categorias.index') }}" 
                       class="flex items-center px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg transition {{ request()->routeIs('categorias.*') ? 'bg-purple-50 text-purple-700 font-semibold' : '' }}">
                        <span class="w-8 text-center"></span>
                        <span>Categorías</span>
                    </a>
                    

                </div>

                <!-- Cerrar sesión -->
                <div class="mt-8 pt-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <span class="w-8 text-center"></span>
                            <span>Cerrar sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Contenido principal -->
 
        <main class="flex-1 p-8">
 
        <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Panel de Administración</h1>
                <p class="text-gray-600 mt-1">Gestiona los eventos y categorías de la agenda cultural</p>
            </div>

            <!-- Conteo-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-600">Total Eventos</p>
                    <p class="text-2xl font-bold">{{ \App\Models\Evento::count() }}</p>
                    <p class="text-xs text-gray-500 mt-1">Eventos registrados en el sistema</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                    <p class="text-sm text-gray-600">Categorías</p>
                    <p class="text-2xl font-bold">{{ \App\Models\Categoria::count() }}</p>
                    <p class="text-xs text-gray-500 mt-1">Categorías para clasificar eventos</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Módulo Eventos -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-blue-600 p-4">
                        <h2 class="text-xl font-bold text-white">Gestión de Eventos</h2>
                    </div>
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Administra los eventos culturales (CRUD completo)</p>
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
                    <div class="p-4">
                        <p class="text-gray-600 text-sm mb-4">Administra las categorías para clasificar eventos</p>
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
            </div>

            <!-- Acciones rápidas adicionales 
            <div class="mt-8 bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Acciones rápidas</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('eventos.create') }}" 
                       class="bg-blue-100 text-blue-700 px-4 py-2 rounded hover:bg-blue-200 transition">
                        + Crear nuevo evento
                    </a>
                    <a href="{{ route('categorias.create') }}" 
                       class="bg-purple-100 text-purple-700 px-4 py-2 rounded hover:bg-purple-200 transition">
                        + Crear nueva categoría
                    </a>
                </div>-->
            </div>
        </main>
    </div>

</x-layouts.app>
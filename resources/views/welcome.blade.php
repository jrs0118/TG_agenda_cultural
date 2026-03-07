<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda Cultural de Medellín</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header con navegación -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Agenda Cultural Medellín</h1>
                
                @if (Route::has('login'))
                    <nav class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Panel Admin
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-600 hover:text-gray-900 px-4 py-2">Iniciar Sesión</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Título y descripción -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Agenda Cultural</h2>
            <p class="text-gray-600 mt-2">Descubre los mejores eventos culturales en Medellín</p>
        </div>


        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filtrar por categoría -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                    <select name="categoria" class="w-full border rounded-lg p-2">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" 
                                {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtrar por fecha -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" name="fecha" value="{{ request('fecha') }}" 
                           class="w-full border rounded-lg p-2">
                </div>

                <!-- Filtrar por ubicación -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                    <select name="ubicacion" class="w-full border rounded-lg p-2">
                        <option value="">Todas las ubicaciones</option>
                        @foreach($ubicaciones ?? [] as $ubicacion)
                            <option value="{{ $ubicacion->id_ubicacion }}" 
                                {{ request('ubicacion') == $ubicacion->id_ubicacion ? 'selected' : '' }}>
                                {{ $ubicacion->nombre_lugar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex-1">
                        Filtrar
                    </button>
                    <a href="{{ route('home') }}" 
                       class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($eventos as $evento)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">
                                {{ $evento->categoria->nombre_categoria ?? 'Sin categoría' }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-semibold mb-2">{{ $evento->nombre_evento }}</h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $evento->descripcion ?? 'Sin descripción' }}
                        </p>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <div>Fecha: {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</div>
                            <div>Hora: {{ \Carbon\Carbon::parse($evento->hora)->format('g:i A') }}</div>
                            <div>Lugar: {{ $evento->ubicacion->nombre_lugar ?? 'Por definir' }}</div>
                        </div>
                        
                        <a href="#" class="block text-center bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">No hay eventos disponibles para los filtros seleccionados.</p>
                </div>
            @endforelse
        </div>


        <div class="mt-8">
            {{ $eventos->links() }}
        </div>
    </main>

    
    <footer class="bg-white border-t mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500">
            <p>{{ date('Y') }} Agenda Cultural de Medellín</p>
        </div>
    </footer>
</body>
</html>
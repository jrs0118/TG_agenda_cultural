<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda Cultural - Medellín</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .hero-pattern {
            background: linear-gradient(rgba(0, 51, 160, 0.85), rgba(0, 51, 160, 0.85)), url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .filter-input {
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .filter-input:focus {
            border-color: #0033A0;
            box-shadow: 0 0 0 3px rgba(0, 51, 160, 0.1);
        }
    </style>
</head>
<body class="font-[inter] bg-gray-50">

    <!-- Header institucional -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo y título -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-[#0033A0] rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">Agenda Cultural</h1>
                        <p class="text-sm text-gray-500">Alcaldía de Medellín</p>
                    </div>
                </div>

                <!-- Login/Register -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="bg-[#0033A0] text-white px-5 py-2.5 rounded-lg hover:bg-[#002070] transition flex items-center space-x-2">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Panel de Control</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 hover:text-[#0033A0] px-4 py-2.5 transition flex items-center space-x-2">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Ingresar</span>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition border border-gray-200">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Hero section institucional -->
    <div class="hero-pattern text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm mb-6">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Agenda Cultural de Medellín
                </span>
                <h2 class="text-5xl font-bold mb-6">Descubre la cultura</h2>
                <p class="text-xl mb-8 opacity-90 leading-relaxed">
                    Conciertos, teatro, danza, exposiciones y más. La oferta cultural 
                    de Medellín a un clic de distancia.
                </p>
                
                 </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <!-- Título de sección -->
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Eventos destacados</h3>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Explora la programación cultural de la ciudad y encuentra los eventos que más te interesan
            </p>
        </div>

        <!-- Filtros mejorados -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-[#0033A0]/10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-filter text-[#0033A0]"></i>
                </div>
                <h4 class="text-lg font-semibold text-gray-900">Filtrar eventos</h4>
            </div>
            
            <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag text-[#0033A0] mr-2"></i>
                        Categoría
                    </label>
                    <select name="categoria" class="w-full border-2 border-gray-200 rounded-xl p-3 filter-input">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria }}" 
                                {{ request('categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar text-[#0033A0] mr-2"></i>
                        Fecha
                    </label>
                    <input type="date" name="fecha" value="{{ request('fecha') }}" 
                           class="w-full border-2 border-gray-200 rounded-xl p-3 filter-input">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-[#0033A0] mr-2"></i>
                        Ubicación
                    </label>
                    <select name="ubicacion" class="w-full border-2 border-gray-200 rounded-xl p-3 filter-input">
                        <option value="">Todos los lugares</option>
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
                            class="flex-1 bg-[#0033A0] text-white px-6 py-3 rounded-xl hover:bg-[#002070] transition flex items-center justify-center gap-2">
                        <i class="fas fa-search"></i>
                        Filtrar
                    </button>
                    <a href="{{ route('home') }}" 
                       class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition border border-gray-200">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Grid de eventos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($eventos as $evento)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover">
                    
                    @if($evento->imagen)
                        <img src="{{ Storage::url($evento->imagen) }}" 
                             alt="{{ $evento->nombre_evento }}"
                             class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-[#0033A0]/5 to-purple-500/5 flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-6xl text-[#0033A0]/20"></i>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <!-- Categoría -->
                        <div class="flex items-center gap-2 mb-3">
                            <span class="bg-[#0033A0]/10 text-[#0033A0] text-xs px-3 py-1.5 rounded-full font-medium">
                                <i class="fas fa-tag mr-1"></i>
                                {{ $evento->categoria->nombre_categoria ?? 'Sin categoría' }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-3 text-gray-900">{{ $evento->nombre_evento }}</h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $evento->descripcion ?? 'Sin descripción' }}
                        </p>
                        
                        <!-- Detalles -->
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-[#0033A0]"></i>
                                <span>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-clock w-5 text-[#0033A0]"></i>
                                <span>{{ \Carbon\Carbon::parse($evento->hora)->format('g:i A') }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt w-5 text-[#0033A0]"></i>
                                <span>{{ $evento->ubicacion->nombre_lugar ?? 'Por definir' }}</span>
                            </div>
                        </div>
                        
                        <!-- Botón -->
                        <a href="{{ route('eventos.show', $evento->id_evento) }}" 
                           class="block text-center border-2 border-[#0033A0] text-[#0033A0] py-3 rounded-xl hover:bg-[#0033A0] hover:text-white transition-all font-medium">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-xl">No hay eventos disponibles</p>
                    <p class="text-gray-400 mt-2">Prueba con otros filtros o vuelve más tarde</p>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-12">
            {{ $eventos->links() }}
        </div>
    </main>

    <!-- Footer institucional -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Logo y descripción -->
                <div class="col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-[#0033A0] rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Agenda Cultural</h3>
                            <p class="text-sm text-gray-400">Alcaldía de Medellín</p>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        La Secretaría de Cultura Ciudadana de Medellín te invita a disfrutar de la programación 
                        cultural de la ciudad. Conciertos, teatro, danza y exposiciones para todos los gustos.
                    </p>
                </div>

                <!-- Enlaces rápidos -->
                <div>
                    <h4 class="font-semibold mb-6 text-white">Enlaces de interés</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Eventos</a></li>
                        <li><a href="#" class="hover:text-white transition">Preguntas frecuentes</a></li>
                        <li><a href="#" class="hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>

                <!-- Redes sociales -->
                <div>
                    <h4 class="font-semibold mb-6 text-white">Síguenos</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-[#0033A0] transition">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-[#0033A0] transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-xl flex items-center justify-center hover:bg-[#0033A0] transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright INVESTIGAR MÁS SOBRE EL COPYRIGH-->

        </div>
    </footer>

    <!-- Estilos para la paginación -->
    <style>
        .pagination {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            justify-content: center;
        }
        .pagination li a, .pagination li span {
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            color: #4b5563;
            transition: all 0.3s;
            display: inline-block;
        }
        .pagination li.active span {
            background: #0033A0;
            color: white;
            border-color: #0033A0;
        }
        .pagination li a:hover {
            border-color: #0033A0;
            color: #0033A0;
        }
    </style>
</body>
</html>
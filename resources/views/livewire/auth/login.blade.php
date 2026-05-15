<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Agenda Cultural Medellín</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .login-pattern {
            background: linear-gradient(135deg, rgba(0, 51, 160, 0.95), rgba(0, 51, 160, 0.85)), url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-[inter] bg-gray-50 min-h-screen flex items-center justify-center p-4 login-pattern">
    
    <div class="w-full max-w-md">
        <!-- Logo y título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-4">
                <i class="fas fa-calendar-alt text-4xl text-[#0033A0]"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Agenda Cultural</h2>
            <p class="text-white/80 mt-2"></p>
        </div>

        <!-- Tarjeta de login -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Iniciar Sesión</h3>
                <p class="text-gray-600 mt-2">Ingresa tu correo y contraseña para acceder al panel</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6">
                    <div class="flex">
                        <i class="fas fa-check-circle mt-0.5 mr-3"></i>
                        <p>{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-[#0033A0] mr-2"></i>
                        Correo electrónico
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           placeholder="ejemplo@correo.com"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0033A0] focus:ring focus:ring-[#0033A0]/20 transition @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-[#0033A0] mr-2"></i>
                        Contraseña
                    </label>
                    <div class="relative">
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0033A0] focus:ring focus:ring-[#0033A0]/20 transition pr-12 @error('password') border-red-500 @enderror">
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#0033A0] transition">
                            <i class="far fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Recordarme y olvidé contraseña -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-[#0033A0] border-gray-300 rounded focus:ring-[#0033A0]">
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#0033A0] hover:text-[#002070] transition font-medium">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <!-- Botón de inicio de sesión -->
                <button type="submit" 
                        class="w-full bg-[#0033A0] text-white py-3.5 rounded-xl hover:bg-[#002070] transition-all shadow-lg hover:shadow-xl font-semibold text-lg flex items-center justify-center gap-3">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar sesión
                </button>
<!-- 
                 Línea divisoria 
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500"></span>
                    </div>
                </div> -->

                <!-- Enlace a registro
                @if (Route::has('register'))
                    <p class="text-center text-gray-600">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" class="text-[#0033A0] hover:text-[#002070] transition font-semibold ml-1">
                            Regístrate aquí
                        </a>
                    </p>
                @endif -->
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-white/60 text-sm mt-8">
        </p>
    </div>

    <!-- Script para mostrar/ocultar contraseña -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
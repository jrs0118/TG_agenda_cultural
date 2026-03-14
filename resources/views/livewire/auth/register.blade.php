<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Agenda Cultural Medellín</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .register-pattern {
            background: linear-gradient(135deg, rgba(0, 51, 160, 0.95), rgba(0, 51, 160, 0.85)), url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-[inter] bg-gray-50 min-h-screen flex items-center justify-center p-4 register-pattern">
    
    <div class="w-full max-w-md">
        <!-- Logo y título -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-2xl shadow-lg mb-4">
                <i class="fas fa-calendar-alt text-4xl text-[#0033A0]"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Agenda Cultural</h2>
            <p class="text-white/80 mt-2">Alcaldía de Medellín</p>
        </div>

        <!-- Tarjeta de registro -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Crear una cuenta</h3>
                <p class="text-gray-600 mt-2">Ingresa tus datos para registrarte en el panel</p>
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

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Nombre completo -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-[#0033A0] mr-2"></i>
                        Nombre completo
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           placeholder="Juan Pérez"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0033A0] focus:ring focus:ring-[#0033A0]/20 transition @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Correo electrónico -->
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
                                onclick="togglePassword('password', 'toggleIcon1')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#0033A0] transition">
                            <i class="far fa-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-[#0033A0] mr-2"></i>
                        Confirmar contraseña
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0033A0] focus:ring focus:ring-[#0033A0]/20 transition pr-12">
                        <button type="button" 
                                onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-[#0033A0] transition">
                            <i class="far fa-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <!-- Términos y condiciones -->
                <div class="flex items-start">
                    <input type="checkbox" name="terms" id="terms" required
                           class="w-4 h-4 mt-1 text-[#0033A0] border-gray-300 rounded focus:ring-[#0033A0]">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        Acepto los 
                        <a href="#" class="text-[#0033A0] hover:text-[#002070] transition font-medium">
                            términos y condiciones
                        </a> 
                        y la 
                        <a href="#" class="text-[#0033A0] hover:text-[#002070] transition font-medium">
                            política de privacidad
                        </a>
                    </label>
                </div>

                <!-- Botón de registro -->
                <button type="submit" 
                        class="w-full bg-[#0033A0] text-white py-3.5 rounded-xl hover:bg-[#002070] transition-all shadow-lg hover:shadow-xl font-semibold text-lg flex items-center justify-center gap-3">
                    <i class="fas fa-user-plus"></i>
                    Crear cuenta
                </button>

                <!-- Línea divisoria -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">o</span>
                    </div>
                </div>

                <!-- Enlace a login -->
                <p class="text-center text-gray-600">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text-[#0033A0] hover:text-[#002070] transition font-semibold ml-1">
                        Inicia sesión aquí
                    </a>
                </p>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-white/60 text-sm mt-8">
        </p>
    </div>

    <!-- Script para mostrar/ocultar contraseña -->
    <script>
        function togglePassword(inputId, iconId) {
            const password = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
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
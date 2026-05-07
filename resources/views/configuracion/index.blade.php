<x-layouts.app :title="__('Configuración General')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-cog text-[#0033A0] mr-2"></i>
                        Configuración General
                    </h1>
                    <p class="text-gray-600 mt-1">Administra tu perfil y ajustes del sistema</p>
                </div>
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tarjeta de Perfil -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-[#0033A0] px-6 py-4">
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-user-circle mr-2"></i>
                        Mi Perfil
                    </h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('configuracion.perfil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-user text-[#0033A0] mr-1"></i>
                                    Nombre completo *
                                </label>
                                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" 
                                       class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-envelope text-[#0033A0] mr-1"></i>
                                    Correo electrónico
                                </label>
                                <input type="email" value="{{ Auth::user()->email }}" 
                                       class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" disabled>
                                <p class="text-xs text-gray-400 mt-1">El correo no puede ser modificado</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-phone text-[#0033A0] mr-1"></i>
                                    Teléfono (opcional)
                                </label>
                                <input type="text" name="telefono" value="{{ old('telefono', Auth::user()->telefono) }}" 
                                       class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]"
                                       placeholder="Ej: 3001234567">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-tag text-[#0033A0] mr-1"></i>
                                    Rol
                                </label>
                                <input type="text" value="{{ Auth::user()->rol->nombre_rol ?? 'Administrador' }}" 
                                       class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" disabled>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t">
                            <button type="submit" class="bg-[#0033A0] text-white px-6 py-2 rounded-lg hover:bg-[#002070] transition flex items-center gap-2">
                                <i class="fas fa-save"></i> Actualizar Perfil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tarjeta de Cambiar Contraseña -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-lock mr-2"></i>
                        Cambiar Contraseña
                    </h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('configuracion.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Contraseña actual *
                            </label>
                            <input type="password" name="current_password" 
                                   class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nueva contraseña *
                                </label>
                                <input type="password" name="password" 
                                       class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Confirmar nueva contraseña *
                                </label>
                                <input type="password" name="password_confirmation" 
                                       class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t">
                            <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition flex items-center gap-2">
                                <i class="fas fa-key"></i> Cambiar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                <div class="flex">
                    <i class="fas fa-info-circle text-blue-400 mr-3 mt-1"></i>
                    <div>
                        <p class="text-sm text-blue-700">
                            <strong>Información de la cuenta</strong>
                        </p>
                        <p class="text-xs text-blue-600 mt-1">
                            Miembro desde: {{ Auth::user()->created_at ? Auth::user()->created_at->format('d/m/Y') : 'N/A' }}
                        </p>
                        <p class="text-xs text-blue-600">
                            Último acceso: {{ Auth::user()->last_login_at ? \Carbon\Carbon::parse(Auth::user()->last_login_at)->format('d/m/Y H:i') : 'Primera vez' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
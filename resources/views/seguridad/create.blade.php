<x-layouts.app :title="__('Crear Gestor Cultural')">

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Crear Nuevo Gestor Cultural</h1>
                <a href="{{ route('seguridad.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    Volver
                </a>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('seguridad.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo *</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico *</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                               class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña *</label>
                        <input type="password" name="password" 
                               class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar contraseña *</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rol *</label>
                        <select name="id_rol" class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#0033A0]" required>
                            <option value="">Seleccione un rol</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id_rol }}" {{ old('id_rol') == $rol->id_rol ? 'selected' : '' }}>
                                    {{ $rol->nombre_rol }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end pt-4 border-t">
                        <button type="submit" class="bg-[#0033A0] text-white px-6 py-2 rounded-lg hover:bg-[#002070] transition">
                            <i class="fas fa-save mr-2"></i>Guardar Gestor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.app>
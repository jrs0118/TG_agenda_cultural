<x-layouts.app :title="__('Crear Categoría')">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="font-size: 24px; margin-bottom: 20px;">Crear Nueva Categoría</h1>

        @if($errors->any())
            <div style="background: #fee; color: #c00; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categorias.store') }}" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre de la categoría *</label>
                <input type="text" 
                       name="nombre_categoria" 
                       value="{{ old('nombre_categoria') }}"
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"
                       required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Descripción</label>
                <textarea name="descripcion" 
                          rows="4"
                          style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('descripcion') }}</textarea>
            </div>

            <div style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                <a href="{{ route('categorias.index') }}" 
                   style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px;">
                    Cancelar
                </a>
                <button type="submit" 
                        style="padding: 10px 20px; background: #800080; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Guardar Categoría
                </button>
            </div>
        </form>
    </div>

</x-layouts.app>
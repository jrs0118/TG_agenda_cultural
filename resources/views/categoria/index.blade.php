<!-- En la tabla, agrega una columna para Tipo -->
<thead class="bg-gray-50">
    <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th> <!-- NUEVA -->
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eventos</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
    </tr>
</thead>
<tbody>
    @forelse($categorias as $categoria)
    <tr>
        <td class="px-6 py-4 whitespace-nowrap">{{ $categoria->id_categoria }}</td>
        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $categoria->nombre_categoria }}</td>
        <td class="px-6 py-4 whitespace-nowrap">
            @switch($categoria->tipo_categoria)
                @case('Música')
                    <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-800">🎵 Música</span>
                    @break
                @case('Danza')
                    <span class="px-2 py-1 rounded-full bg-pink-100 text-pink-800">💃 Danza</span>
                    @break
                @case('Artes Plásticas')
                    <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800">🎨 Artes</span>
                    @break
                @case('Audiovisuales')
                    <span class="px-2 py-1 rounded-full bg-green-100 text-green-800">🎬 Audiovisuales</span>
                    @break
                @case('Teatro')
                    <span class="px-2 py-1 rounded-full bg-purple-100 text-purple-800">🎭 Teatro</span>
                    @break
                @default
                    <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800">📌 {{ $categoria->tipo_categoria }}</span>
            @endswitch
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                {{ $categoria->eventos->count() }} eventos
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
            <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" 
               class="text-yellow-600 hover:text-yellow-900">Editar</a>
            <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" 
                  method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900" 
                        onclick="return confirm('¿Eliminar esta categoría?')">
                    Eliminar
                </button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500"> <!-- colspan="5" por la nueva columna -->
            No hay categorías registradas
        </td>
    </tr>
    @endforelse
</tbody>
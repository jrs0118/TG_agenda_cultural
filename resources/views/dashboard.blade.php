<x-layouts.app :title="__('Menú - Agenda Cultural')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        <!-- SECCIÓN EVENTOS -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-2">

            <!-- Crear Evento -->
            <a href="{{ route('eventos.create') }}"
               class="flex items-center justify-center rounded-xl border border-neutral-200 
                      dark:border-neutral-700 bg-blue-600 text-white p-6 
                      hover:bg-blue-700 transition shadow-lg">

                <div class="text-center">
                    <h2 class="text-xl font-bold text-black">Gestión de Eventos</h2>
                    <p class="text-sm mt-2 text-black">Registrar nuevo evento cultural</p>
                </div>

            </a>

            <!-- Ver Eventos -->
            <a href="{{ route('eventos.index') }}"
               class="flex items-center justify-center rounded-xl border border-neutral-200 
                      dark:border-neutral-700 bg-green-600 text-white p-6 
                      hover:bg-green-700 transition shadow-lg">

                <div class="text-center">
                    <h2 class="text-xl font-bold text-black">Ver Eventos</h2>
                    <p class="text-sm mt-2 text-black">Consultar eventos registrados</p>
                </div>

            </a>

        </div>

        <!-- SECCIÓN CATEGORÍAS -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-1 mt-6">
            <!-- Crear Categoría -->
            <a href="{{ route('categorias.create') }}"
               class="flex items-center justify-center rounded-xl border border-neutral-200 
                      dark:border-neutral-700 bg-purple-600 text-white p-6 
                      hover:bg-purple-700 transition shadow-lg">

                <div class="text-center">
                    <h2 class="text-xl font-bold text-black">Gestión de categorias</h2>
                    <p class="text-sm mt-2 text-black">Agregar nueva categoría</p>
                </div>

            </a>
        </div>

    </div>

</x-layouts.app>
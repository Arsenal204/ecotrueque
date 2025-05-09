<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Mis objetos publicados') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #AB80E5;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Botón de añadir nuevo -->
            <a href="{{ route('objetos.create') }}" class="mb-6 inline-block px-4 py-2 text-white rounded"
                style="background-color: #39c149;">
                + Publicar nuevo objeto
            </a>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="mb-6 p-3 rounded text-white" style="background-color: #39c149;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Contenido -->
            @if ($objetos->isEmpty())
                <p class="text-white">No has publicado ningún objeto aún.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($objetos as $objeto)
                        <div class="rounded shadow p-4 flex flex-col justify-between"
                            style="background-color: #d450aa; color: white;">

                            <!-- Imagen -->
                            @php
                                $imagen = $objeto->imagenes->first();
                            @endphp
                            <img src="{{ $imagen ? asset('storage/' . $imagen->ruta_imagen) : asset('images/placeholder.png') }}"
                                alt="Imagen del objeto" class="h-48 w-full object-cover rounded mb-4">

                            <!-- Detalles -->
                            <div>
                                <h3 class="text-lg font-bold mb-1">{{ $objeto->titulo }}</h3>
                                <p class="text-sm">Estado: {{ $objeto->estado }}</p>
                                <p class="text-sm">Oferta: {{ ucfirst($objeto->tipo_oferta) }}</p>
                                <p class="text-sm">
                                    Categoría: {{ $categorias[$objeto->categoria]->nombre_categoria ?? '-' }}
                                </p>
                            </div>

                            <!-- Botones -->
                            <div class="mt-4 flex gap-2">
                                <button onclick="window.location='{{ route('objetos.show', $objeto) }}'"
                                    class="flex-1 text-white text-sm py-1 px-2 rounded"
                                    style="background-color: #7db6d4;">
                                    Ver
                                </button>

                                <button onclick="window.location='{{ route('objetos.edit', $objeto) }}'"
                                    class="flex-1 text-black text-sm py-1 px-2 rounded"
                                    style="background-color: #e6d324;">
                                    Editar
                                </button>

                                <form action="{{ route('objetos.destroy', $objeto) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('¿Eliminar este objeto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-white text-sm py-1 px-2 rounded"
                                        style="background-color: #e10909;">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

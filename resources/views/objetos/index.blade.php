<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Mis objetos publicados') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #ebdba7;">
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
                            style="background-color: #a4dc56; color: white;">

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
                                <!-- Ver -->
                                <button onclick="window.location='{{ route('objetos.show', $objeto) }}'"
                                    class="flex-1 text-white text-sm py-1 px-2 rounded"
                                    style="background-color: #7db6d4; display:flex; align-items:center; justify-content:center; gap:0.4rem;">
                                    <!-- Ojo SVG -->
                                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                        style="vertical-align:middle;">
                                        <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12z"
                                            stroke="#fff" stroke-width="2" fill="none" />
                                        <circle cx="12" cy="12" r="3" stroke="#fff" stroke-width="2"
                                            fill="none" />
                                    </svg>
                                    Ver
                                </button>

                                <!-- Editar -->
                                <button onclick="window.location='{{ route('objetos.edit', $objeto) }}'"
                                    class="flex-1 text-black text-sm py-1 px-2 rounded"
                                    style="background-color: #e6d324; display:flex; align-items:center; justify-content:center; gap:0.4rem;">
                                    <!-- Lápiz SVG -->
                                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                        style="vertical-align:middle;">
                                        <path
                                            d="M4 20h4l10.29-10.29a1 1 0 0 0 0-1.41l-2.59-2.59a1 1 0 0 0-1.41 0L4 16v4z"
                                            stroke="#222" stroke-width="2" fill="none" />
                                        <path d="M14.5 7.5l2 2" stroke="#222" stroke-width="2" fill="none" />
                                    </svg>
                                    Editar
                                </button>

                                <!-- Eliminar -->
                                <form action="{{ route('objetos.destroy', $objeto) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('¿Eliminar este objeto?');" style="display:flex;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-white text-sm py-1 px-2 rounded"
                                        style="background-color: #e10909; display:flex; align-items:center; justify-content:center; gap:0.4rem;">
                                        <!-- Papelera SVG -->
                                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                            style="vertical-align:middle;">
                                            <rect x="5" y="7" width="14" height="12" rx="2"
                                                stroke="#fff" stroke-width="2" fill="none" />
                                            <path d="M3 7h18" stroke="#fff" stroke-width="2" />
                                            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#fff"
                                                stroke-width="2" />
                                        </svg>
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

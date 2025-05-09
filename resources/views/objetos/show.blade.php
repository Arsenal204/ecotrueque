<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Detalle del objeto') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #AB80E5;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded shadow p-6 text-white" style="background-color: #B4007C;">

                <!-- Galería de imágenes -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    @forelse ($objeto->imagenes as $imagen)
                        <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" class="w-full h-48 object-cover rounded"
                            alt="Imagen">
                    @empty
                        <img src="{{ asset('images/placeholder.png') }}" class="w-full h-48 object-cover rounded"
                            alt="Sin imagen">
                    @endforelse
                </div>

                <!-- Información del objeto -->
                <h3 class="text-2xl font-bold mb-2">{{ $objeto->titulo }}</h3>
                <p class="mb-1"><strong>Estado:</strong> {{ $objeto->estado }}</p>
                <p class="mb-1"><strong>Oferta:</strong> {{ ucfirst($objeto->tipo_oferta) }}</p>
                <p class="mb-1"><strong>Categoría:</strong> {{ $objeto->categoria->nombre_categoria ?? '-' }}</p>
                <p class="mt-4"><strong>Descripción:</strong><br>{{ $objeto->descripcion }}</p>

                <!-- Botón volver -->
                <div class="mt-6">
                    <a href="{{ route('objetos.index') }}" class="inline-block px-4 py-2 rounded text-black font-medium"
                        style="background-color: #94D7FB;">
                        ← Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

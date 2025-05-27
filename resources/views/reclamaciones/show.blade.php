<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Detalles de la reclamación
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen" style="background-color: #ebdba7;">
        <div class="max-w-4xl mx-auto p-6 rounded shadow text-black dark:text-white" style="background-color: #e2cc82;">
            <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-md">
                <h3 class="text-lg font-bold mb-2">Motivo</h3>
                <p>{{ $reclamacion->motivo }}</p>

                <h3 class="text-lg font-bold mt-4 mb-2">Descripción</h3>
                <p>{{ $reclamacion->descripcion ?? 'No se proporcionó descripción.' }}</p>

                <h3 class="text-lg font-bold mt-4 mb-2">Estado</h3>
                <p>{{ ucfirst($reclamacion->estado_reclamacion) }}</p>

                <h3 class="text-lg font-bold mt-4 mb-2">Fecha de reclamación</h3>
                <p>{{ $reclamacion->fecha_reclamacion->format('d/m/Y') }}</p>

                <h3 class="text-lg font-bold mt-4 mb-2">Usuario reclamado</h3>
                <p>{{ $reclamacion->usuarioReclamado->name ?? 'Desconocido' }}</p>

                @if ($reclamacion->imagenes && $reclamacion->imagenes->count() > 0)
                    <h3 class="text-lg font-bold mt-6 mb-2">Imágenes adjuntas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($reclamacion->imagenes as $imagen)
                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" class="object-cover rounded"
                                style="width: 266px; height: 266px;" alt="Imagen de la reclamación">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('reclamaciones.index') }}"
                    class="inline-block px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-black rounded font-semibold">
                    Volver a mis reclamaciones
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

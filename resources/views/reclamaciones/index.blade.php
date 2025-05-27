<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Mis reclamaciones
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen" style="background-color: #ebdba7;">
        <div class="max-w-5xl mx-auto p-6 rounded shadow" style="background-color: #e2cc82;">
            @if ($reclamaciones->isEmpty())
                <p class="text-white text-center">No has realizado ninguna reclamación todavía.</p>
            @else
                <div class="space-y-4">
                    @foreach ($reclamaciones as $reclamacion)
                        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow-md text-black dark:text-white mb-2">
                            <h3 class="text-lg font-bold">{{ $reclamacion->motivo }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Estado: <span
                                    class="font-semibold">{{ ucfirst($reclamacion->estado_reclamacion) }}</span>
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                Fecha: {{ $reclamacion->fecha_reclamacion->format('d/m/Y') }}
                            </p>
                            <p class="mt-2 text-sm italic">
                                {{ Str::limit($reclamacion->descripcion, 100) }}
                            </p>

                            <a href="{{ route('reclamaciones.showUser', $reclamacion->id) }}"
                                class="inline-block mt-3 px-3 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 text-sm">
                                Ver detalle
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

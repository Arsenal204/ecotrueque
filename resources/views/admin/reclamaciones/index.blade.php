<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Reclamaciones recibidas
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen" style="background-color: #ebdba7;">
        <div class="max-w-6xl mx-auto p-6 rounded shadow text-black" style="background-color: #ebdba7;">
            @if (session('success'))
                <div class="mb-4 p-3
            bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($reclamaciones as $reclamacion)
                <div class="p-4 mb-4 border rounded " style="background-color: #e2cc82;">
                    <p><strong>Motivo:</strong> {{ $reclamacion->motivo }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($reclamacion->estado_reclamacion) }}</p>
                    <p><strong>Reclamante:</strong> {{ $reclamacion->emisor->name }}</p>
                    <p><strong>Reclamado:</strong> {{ $reclamacion->reclamado->name }}</p>
                    <a href="{{ route('admin.reclamaciones.show', $reclamacion->id) }}"
                        class="inline-block mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                        Ver detalles
                    </a>
                </div>
            @empty
                <p>No hay reclamaciones registradas.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Solicitar intercambio
        </h2>
    </x-slot>

    <div class="py-6  min-h-screen" style="background-color: #ebdba7;">
        <div class="max-w-4xl mx-auto p-6 rounded shadow text-black dark:text-white">
            <h3 class="text-lg font-semibold mb-4">Objeto a intercambiar de
                {{ $objetoReceptor->usuario()->first()->name }}</h3>

            <div class=" p-4 rounded mb-6">
                <img src="{{ $objetoReceptor->imagenes->first() ? asset('storage/' . $objetoReceptor->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                    class="w-40 h-30 object-cover rounded mb-2" />
                <h4 class="font-bold">{{ $objetoReceptor->titulo }}</h4>
                <p class="text-sm">{{ $objetoReceptor->descripcion }}</p>
                @php
                    $cat = \App\Models\Categoria::find($objetoReceptor->categoria);
                @endphp

                <p class="text-xs text-gray-300">
                    Categoría: {{ $cat?->nombre_categoria ?? 'Sin categoría' }}
                </p>
            </div>

            <form method="POST" action="{{ route('intercambios.store') }}">
                @csrf
                <input type="hidden" name="id_objeto_receptor" value="{{ $objetoReceptor->id }}">

                <label for="id_objeto_emisor" class="block font-semibold mb-2 text-white">Selecciona uno de tus
                    objetos:</label>
                <select name="id_objeto_emisor" id="id_objeto_emisor" class="w-full mb-4 p-2 rounded"
                    style="color: black;" required>
                    @forelse ($misObjetos as $objeto)
                        <option value="{{ $objeto->id }}">
                            {{ $objeto->titulo }} ({{ $objeto->estado }})
                        </option>
                    @empty
                        <option disabled>No tienes objetos disponibles para intercambiar.</option>
                    @endforelse
                </select>

                <button type="submit" class=" hover:bg-yellow-400 text-black font-bold px-4 py-2 rounded"
                    style="background-color: #ddcb26;">
                    Enviar solicitud
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

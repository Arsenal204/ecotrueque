<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Conversación con {{ $usuario->name }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #AB80E5;">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded shadow">
            <!-- Zona de mensajes -->
            <div class="p-6 h-[500px] overflow-y-auto" style="background-color: #AB80E5;">
                @forelse ($mensajes as $mensaje)
                    <div class="mb-4 flex {{ $mensaje->id_emisor === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        @if ($mensaje->id_emisor === auth()->id())
                            <div class="max-w-[70%] px-4 py-2 rounded-lg" style="background-color: #FFEA27; text-black;">
                            @else
                                <div
                                    class="max-w-[70%] px-4 py-2 rounded-lg "style="background-color: #B4007C; text-white;">
                        @endif
                        <p class="text-sm">{{ $mensaje->contenido }}</p>
                        <span class="block text-xs mt-1 text-gray-200">
                            {{ $mensaje->created_at->format('H:i d/m/Y') }}
                        </span>
                    </div>

            </div>
        @empty
            <p class="text-center text-white">No hay mensajes aún.</p>
            @endforelse
        </div>

        <!-- Formulario de envío -->
        <form method="POST" action="{{ route('mensajes.store') }}"
            class="flex items-center border-t border-gray-200 p-4"style="background-color: #AB80E5;">
            @csrf
            <input type="hidden" name="id_receptor" value="{{ $usuario->id }}">

            <input type="text" name="contenido" required placeholder="Escribe un mensaje..."
                class="flex-1 px-4 py-2 border rounded-lg text-black mr-2"style="background-color: #AB80E5;" />

            <button type="submit" class="hover:bg-yellow-400 text-black font-semibold px-4 py-2 rounded transition"
                style="background-color: #FFEA27;">
                Enviar
            </button>
        </form>
    </div>
    </div>
</x-app-layout>

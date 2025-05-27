<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-black leading-tight">
            Enviar mensaje a {{ $receptor->name }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #e2cc82;">
        <div class="max-w-xl mx-auto bg-[#B4007C] text-black p-6 rounded shadow-lg">
            <form action="{{ route('mensajes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_receptor" value="{{ $receptor->id }}">

                <div class="mb-4">
                    <label for="contenido" class="block mb-1 text-sm">Mensaje</label>
                    <textarea name="contenido" id="contenido" rows="4" required class="w-full p-2 rounded text-black"
                        placeholder="Escribe tu mensaje..."></textarea>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-[#FFEA27] text-black px-4 py-2 rounded hover:bg-yellow-400 transition">
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

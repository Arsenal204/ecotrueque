<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">Conversaciones</h2>
    </x-slot>

    <div class="py-6" style="background-color: #e2cc82;">
        <div class="max-w-3xl mx-auto bg-[#B4007C] p-6 rounded shadow text-white">
            <h3 class="text-lg mb-4">Usuarios con los que has hablado</h3>

            @if ($usuariosConConversacion->isEmpty())
                <p class="text-center">Aún no tienes conversaciones.</p>
            @else
                <ul>
                    @foreach ($usuariosConConversacion as $user)
                        <li class="mb-3">
                            <a href="{{ route('mensajes.conversacion', $user) }}"
                                class="block px-4 py-2 bg-[#FFEA27] text-black rounded hover:bg-yellow-400 transition">
                                {{ $user->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>

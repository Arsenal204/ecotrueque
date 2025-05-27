<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Usuarios registrados
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen" style="background-color: #ebdba7;">
        <div class="max-w-6xl mx-autop-6 rounded shadow text-black dark:text-white" style="background-color: #ebdba7;">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3
            gap-6">
                @forelse ($usuarios as $usuario)
                    <div class="text-white p-4 rounded shadow" style="background-color: #e2cc82;">
                        <h3 class="text-lg font-semibold
                        mb-1">{{ $usuario->name }}</h3>
                        <p class="text-sm mb-2">Rol: {{ ucfirst($usuario->tipo_usuario) }}</p>

                        @php
                            $media = $usuario->valoraciones()->avg('puntuacion');
                            $media = round($media, 1);
                        @endphp

                        <p class=" font-bold" style="color: yellow;">
                            @if ($media)
                                {{ str_repeat('⭐', floor($media)) }}
                                @if ($media - floor($media) >= 0.5)
                                    ⭐
                                @endif
                                <span class="text-sm text-gray-200">({{ $media }}/5)</span>
                            @else
                                Sin valoraciones
                            @endif
                        </p>

                        <a href="{{ route('usuarios.show', $usuario) }}"
                            class="inline-block mt-3 bg-[#FFEA27] text-black px-4 py-2 rounded hover:bg-yellow-400">
                            Ver perfil
                        </a>
                    </div>
                @empty
                    <p>No hay otros usuarios registrados.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Perfil de {{ $usuario->name }}
            @if ($mediaPuntuacion > 0)
                <span class="ml-4 text-yellow-300 text-base">
                    {{ str_repeat('⭐', floor($mediaPuntuacion)) }}
                    @if ($mediaPuntuacion - floor($mediaPuntuacion) >= 0.5)
                        ⭐
                    @endif
                    <span class="text-sm text-white ml-2">({{ $mediaPuntuacion }}/5)</span>
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-6 min-h-screen" style="background-color: #ebdba7;">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Información del usuario -->
            <div class="max-w-7xl mx-auto p-6 rounded shadow text-black dark:text-white"
                style="background-color: #e2cc82;">
                <h3 class="text-lg font-semibold mb-3">Información</h3>
                <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
                <p><strong>Email:</strong> {{ $usuario->email }}</p>
                <p><strong>Rol:</strong> {{ ucfirst($usuario->tipo_usuario) }}</p>
            </div>

            <!-- Objetos publicados -->
            <div class="mb-10">
                <h3 class="text-lg font-semibold text-white mb-4">Objetos publicados por {{ $usuario->name }}</h3>

                @php
                    $objetos = \App\Models\Objeto::with('imagenes', 'categoria')
                        ->where('usuario', $usuario->id)
                        ->latest()
                        ->get();
                @endphp

                @if ($objetos->isEmpty())
                    <p class="text-white">Este usuario aún no ha publicado objetos.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($objetos as $objeto)
                            <div
                                class="bg-[#B4007C] text-white p-3 rounded-lg shadow-md flex flex-col justify-between h-full w-full max-w-[250px] mx-auto">
                                <!-- Imagen del objeto -->
                                <img src="{{ $objeto->imagenes->first() ? asset('storage/' . $objeto->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                                    alt="{{ $objeto->titulo }}" class="object-cover rounded bg-white mb-2 p-1"
                                    style="width: 266px; height: 266px;" />

                                <!-- Detalles del objeto -->
                                <h3 class="text-sm font-bold mb-1">{{ Str::limit($objeto->titulo, 25) }}</h3>
                                <p class="text-xs">Estado: {{ $objeto->estado }}</p>
                                <p class="text-xs">Oferta: {{ ucfirst($objeto->tipo_oferta) }}</p>
                                @php $cat = \App\Models\Categoria::find($objeto->categoria); @endphp
                                <p class="text-xs">Categoría: {{ $cat?->nombre_categoria ?? 'Sin categoría' }}</p>

                                <!-- Botón ver más -->
                                <a href="{{ route('objetos.show', $objeto->id) }}"
                                    class="mt-2 block bg-[#FFEA27] text-black font-semibold py-1 px-2 rounded text-xs text-center hover:bg-yellow-400 transition">
                                    Ver más
                                </a>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>

            <!-- Valoración media -->
            @if ($mediaPuntuacion > 0)
                <div class="bg-[#8764b6] p-6 rounded-lg shadow mb-6 text-white">
                    <h3 class="text-lg font-semibold">Valoración media</h3>
                    <p class="text-xl mt-2" style="color: yellow">
                        {{ str_repeat('⭐', floor($mediaPuntuacion)) }}
                        @if ($mediaPuntuacion - floor($mediaPuntuacion) >= 0.5)
                            ⭐
                        @endif
                        <span class="text-sm text-white ml-2">({{ $mediaPuntuacion }} de 5)</span>
                    </p>
                </div>
            @endif

            <!-- Valoraciones recibidas -->
            <div class="bg-[#8764b6] p-6 rounded-lg shadow mb-6 text-white">
                <h3 class="text-lg font-semibold mb-2">Valoraciones recibidas</h3>
                @if ($valoraciones->isEmpty())
                    <p>Este usuario aún no ha recibido valoraciones.</p>
                @else
                    @foreach ($valoraciones as $valoracion)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 mb-3 rounded text-black dark:text-white">
                            <p class="text-yellow-400 font-bold mb-1">
                                {{ str_repeat('⭐', $valoracion->puntuacion) }}
                            </p>
                            <p class="italic">"{{ $valoracion->comentario }}"</p>
                            <p class="text-sm mt-1">
                                Valorado por {{ $valoracion->valorador->name }} -
                                {{ $valoracion->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Formulario para valorar -->
            @if (Auth::id() !== $usuario->id && $puedeValorar && !$yaValorado && isset($intercambio))
                <div class="bg-[#B4007C] text-white p-6 rounded shadow">
                    <h3 class="text-lg font-semibold mb-4">Valorar a este usuario</h3>
                    <form method="POST" action="{{ route('valoraciones.store', $usuario) }}">
                        @csrf

                        <label for="puntuacion" class="block mb-2 font-semibold">Puntuación:</label>
                        <select name="puntuacion" id="puntuacion" class="w-full mb-4 rounded p-2 text-black" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} ⭐</option>
                            @endfor
                        </select>

                        <input type="hidden" name="id_intercambio" value="{{ $intercambio->id }}">

                        <label for="comentario" class="block mb-2 font-semibold">Comentario:</label>
                        <textarea name="comentario" id="comentario" rows="3" class="w-full rounded p-2 mb-4 text-black"
                            placeholder="Escribe un comentario opcional..."></textarea>

                        <button type="submit"
                            class="bg-[#FFEA27] text-black font-bold px-4 py-2 rounded hover:bg-yellow-400">
                            Enviar valoración
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

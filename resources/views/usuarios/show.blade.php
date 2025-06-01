<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.5rem; font-weight:700; color:#fff;">
            Perfil de {{ $usuario->name }}
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div style="max-width:1100px; margin:0 auto;">

            <!-- Información del usuario -->
            <div
                style="background:#e2cc82; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2rem 2.5rem; color:#222; margin-bottom:2.5rem;">
                <h3 style="font-size:1.2rem; font-weight:700; margin-bottom:1rem;">Información</h3>
                <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
                <p><strong>Email:</strong> {{ $usuario->email }}</p>
                <p><strong>Rol:</strong> {{ ucfirst($usuario->tipo_usuario) }}</p>
            </div>

            <!-- Objetos publicados -->
            <div style="margin-bottom:2.5rem;">
                <h3 style="font-size:1.2rem; font-weight:700; color:#5C3F94; margin-bottom:1.2rem;">Objetos publicados
                    por {{ $usuario->name }}</h3>
                @php
                    $objetos = \App\Models\Objeto::with('imagenes', 'categoria')
                        ->where('usuario', $usuario->id)
                        ->latest()
                        ->get();
                @endphp

                @if ($objetos->isEmpty())
                    <p style="color:#00b40f;">Este usuario aún no ha publicado objetos.</p>
                @else
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:1.5rem;">
                        @foreach ($objetos as $objeto)
                            <div
                                style="background:#8dbf48; color:#fff; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:1.2rem 1rem; display:flex; flex-direction:column; align-items:center;">
                                <!-- Imagen del objeto -->
                                <img src="{{ $objeto->imagenes->first() ? asset('storage/' . $objeto->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                                    alt="{{ $objeto->titulo }}"
                                    style="object-fit:cover; border-radius:0.7rem; background:#fff; margin-bottom:1rem; width:200px; height:200px; box-shadow:0 2px 8px rgba(34,139,34,0.10);" />

                                <!-- Detalles del objeto -->
                                <h3 style="font-size:1rem; font-weight:700; margin-bottom:0.3rem;">
                                    {{ Str::limit($objeto->titulo, 25) }}</h3>
                                <p style="font-size:0.95rem;">Estado: {{ $objeto->estado }}</p>
                                <p style="font-size:0.95rem;">Oferta: {{ ucfirst($objeto->tipo_oferta) }}</p>
                                @php $cat = \App\Models\Categoria::find($objeto->categoria); @endphp
                                <p style="font-size:0.95rem;">Categoría:
                                    {{ $cat?->nombre_categoria ?? 'Sin categoría' }}</p>

                                <!-- Botón ver más -->
                                <a href="{{ route('objetos.show', $objeto->id) }}"
                                    style="margin-top:0.8rem; background:#FFEA27; color:#222; font-weight:700; padding:0.5rem 1.2rem; border-radius:0.5rem; text-decoration:none; font-size:0.95rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                                    onmouseover="this.style.background='#ffe066';"
                                    onmouseout="this.style.background='#FFEA27';">
                                    Ver más
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Valoración media -->
            @if ($mediaPuntuacion > 0)
                <div
                    style="background:#76a03b; padding:2rem 2.5rem; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); color:#fff; margin-bottom:2.5rem;">
                    <h3 style="font-size:1.1rem; font-weight:700;">Valoración media</h3>
                    <div style="margin-top:1rem;">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($mediaPuntuacion))
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#FFD700"
                                    style="display:inline;">
                                    <polygon points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9" />
                                </svg>
                            @elseif ($i - $mediaPuntuacion < 1)
                                <svg width="22" height="22" viewBox="0 0 24 24" style="display:inline;">
                                    <defs>
                                        <linearGradient id="half-media">
                                            <stop offset="50%" stop-color="#FFD700" />
                                            <stop offset="50%" stop-color="#ddd" />
                                        </linearGradient>
                                    </defs>
                                    <polygon points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9"
                                        fill="url(#half-media)" />
                                </svg>
                            @else
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="#ddd"
                                    style="display:inline;">
                                    <polygon points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9" />
                                </svg>
                            @endif
                        @endfor
                        @php
                            // Redondea a 1 decimal, pero elimina el decimal si es .0
                            $mediaFormateada =
                                $mediaPuntuacion == intval($mediaPuntuacion)
                                    ? intval($mediaPuntuacion)
                                    : number_format($mediaPuntuacion, 1, ',', '');
                        @endphp
                        <span style="font-size:1rem; color:#fff; margin-left:0.5rem;">({{ $mediaFormateada }} de
                            5)</span>
                    </div>
                </div>
            @endif

            <!-- Valoraciones recibidas -->
            <div
                style="background:#b6e388; padding:2rem 2.5rem; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); color:#222; margin-bottom:2.5rem;">
                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Valoraciones recibidas</h3>
                @if ($valoraciones->isEmpty())
                    <p>Este usuario aún no ha recibido valoraciones.</p>
                @else
                    @foreach ($valoraciones as $valoracion)
                        <div
                            style="background:#f9fafb; color:#222; padding:1rem 1.2rem; border-radius:0.7rem; margin-bottom:1.2rem;">
                            <div style="margin-bottom:0.5rem;">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $valoracion->puntuacion)
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700"
                                            style="display:inline;">
                                            <polygon
                                                points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9" />
                                        </svg>
                                    @else
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#ddd"
                                            style="display:inline;">
                                            <polygon
                                                points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p style="font-style:italic;">"{{ $valoracion->comentario }}"</p>
                            <p style="font-size:0.95rem; margin-top:0.5rem;">
                                Valorado por <strong>{{ $valoracion->valorador->name }}</strong> -
                                {{ $valoracion->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Formulario para valorar -->
            @if (Auth::id() !== $usuario->id && $puedeValorar && !$yaValorado && isset($intercambio))
                <div
                    style="background:#45F85A; color:#222; padding:2rem 2.5rem; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); margin-bottom:2.5rem;">
                    <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem;">Valorar a este usuario</h3>
                    <form method="POST" action="{{ route('valoraciones.store', $usuario) }}">
                        @csrf

                        <label for="puntuacion"
                            style="display:block; margin-bottom:0.5rem; font-weight:600;">Puntuación:</label>
                        <select name="puntuacion" id="puntuacion"
                            style="width:100%; margin-bottom:1rem; border-radius:0.5rem; padding:0.6rem; color:#222; font-size:1rem;">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }} ⭐</option>
                            @endfor
                        </select>

                        <input type="hidden" name="id_intercambio" value="{{ $intercambio->id }}">

                        <label for="comentario"
                            style="display:block; margin-bottom:0.5rem; font-weight:600;">Comentario:</label>
                        <textarea name="comentario" id="comentario" rows="3"
                            style="width:100%; border-radius:0.5rem; padding:0.6rem; margin-bottom:1rem; color:#222; font-size:1rem;"
                            placeholder="Escribe un comentario opcional..."></textarea>

                        <button type="submit"
                            style="background:#76a03b; color:#fff; font-weight:700; padding:0.7rem 2rem; border-radius:0.5rem; border:none; font-size:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                            onmouseover="this.style.background='#5ca82b';"
                            onmouseout="this.style.background='#76a03b';">
                            Enviar valoración
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>

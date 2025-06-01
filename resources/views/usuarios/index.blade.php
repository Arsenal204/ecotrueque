<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.5rem; font-weight:700; color:#fff;">
            Usuarios registrados
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div style="max-width:1200px; margin:0 auto;">
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:2rem;">
                @forelse ($usuarios as $usuario)
                    <div
                        style="background:#e2cc82; color:#222; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2rem 1.5rem; display:flex; flex-direction:column; align-items:center;">
                        <h3 style="font-size:1.2rem; font-weight:700; margin-bottom:0.5rem;">{{ $usuario->name }}</h3>
                        <p style="font-size:1rem; margin-bottom:0.7rem; color:#5C3F94;">Rol:
                            {{ ucfirst($usuario->tipo_usuario) }}</p>

                        @php
                            $media = $usuario->valoraciones()->avg('puntuacion');
                            $media = round($media, 1);
                        @endphp

                        <div style="margin-bottom:1rem;">
                            @if ($media)
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($media))
                                        <!-- Estrella llena -->
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#FFD700"
                                            style="display:inline;">
                                            <polygon
                                                points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9" />
                                        </svg>
                                    @elseif ($i - $media < 1)
                                        <!-- Media estrella -->
                                        <svg width="22" height="22" viewBox="0 0 24 24" style="display:inline;">
                                            <defs>
                                                <linearGradient id="half">
                                                    <stop offset="50%" stop-color="#FFD700" />
                                                    <stop offset="50%" stop-color="#ddd" />
                                                </linearGradient>
                                            </defs>
                                            <polygon
                                                points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9"
                                                fill="url(#half)" />
                                        </svg>
                                    @else
                                        <!-- Estrella vacía -->
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#ddd"
                                            style="display:inline;">
                                            <polygon
                                                points="12,2 15,9 22,9.5 17,14.5 18.5,22 12,18 5.5,22 7,14.5 2,9.5 9,9" />
                                        </svg>
                                    @endif
                                @endfor
                                <span
                                    style="font-size:0.95rem; color:#5C3F94; margin-left:0.5rem;">({{ $media }}/5)</span>
                            @else
                                <span style="color:#b4007c; font-size:0.98rem;">Sin valoraciones</span>
                            @endif
                        </div>

                        <div style="display:flex; gap:0.7rem; margin-top:1rem;">
                            <!-- Ver perfil -->
                            <a href="{{ route('usuarios.show', $usuario) }}"
                                style="background:#FFEA27; color:#222; font-weight:700; padding:0.6rem 1.2rem; border-radius:0.5rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); display:flex; align-items:center; gap:0.4rem; transition:background 0.2s;"
                                onmouseover="this.style.background='#ffe066';"
                                onmouseout="this.style.background='#FFEA27';">
                                <!-- Ojo SVG -->
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                                    <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12z" stroke="#222"
                                        stroke-width="2" fill="none" />
                                    <circle cx="12" cy="12" r="3" stroke="#222" stroke-width="2"
                                        fill="none" />
                                </svg>
                                Perfil
                            </a>

                        </div>
                    </div>
                @empty
                    <p style="color:#b4007c; font-size:1.1rem;">No hay otros usuarios registrados.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

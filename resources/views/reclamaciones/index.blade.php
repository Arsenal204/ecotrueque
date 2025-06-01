<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Mis reclamaciones
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:900px; margin:0 auto; background:#e2cc82; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem;">
            @if ($reclamaciones->isEmpty())
                <p style="color:#b4007c; text-align:center; font-size:1.1rem;">No has realizado ninguna reclamación
                    todavía.</p>
            @else
                <div>
                    @foreach ($reclamaciones as $reclamacion)
                        <div
                            style="background:#fff; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:1.5rem 1.2rem; margin-bottom:1.5rem; border:1px solid #b6e388; color:#222;">
                            <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.5rem; color:#e10909;">
                                {{ $reclamacion->motivo }}</h3>
                            <p style="margin-bottom:0.3rem; font-size:0.97rem;">
                                <strong>Estado:</strong>
                                <span
                                    style="color:{{ $reclamacion->estado_reclamacion === 'pendiente' ? '#b4007c' : ($reclamacion->estado_reclamacion === 'resuelta' ? '#45F85A' : '#e10909') }};">
                                    {{ ucfirst($reclamacion->estado_reclamacion) }}
                                </span>
                            </p>
                            <p style="margin-bottom:0.3rem; font-size:0.97rem;">
                                <strong>Fecha:</strong> {{ $reclamacion->fecha_reclamacion->format('d/m/Y') }}
                            </p>
                            <p style="margin-top:0.7rem; font-size:0.97rem; font-style:italic;">
                                {{ Str::limit($reclamacion->descripcion, 100) }}
                            </p>
                            <a href="{{ route('reclamaciones.showUser', $reclamacion->id) }}"
                                style="display:inline-flex; align-items:center; gap:0.5rem; margin-top:1rem; padding:0.5rem 1.3rem; background:#ffe066; color:#222; border-radius:0.5rem; font-weight:600; font-size:0.98rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                                onmouseover="this.style.background='#ffe9a7';"
                                onmouseout="this.style.background='#ffe066';">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24"
                                    style="vertical-align:middle;">
                                    <path d="M1.5 12s4-7 10.5-7 10.5 7 10.5 7-4 7-10.5 7S1.5 12 1.5 12z" stroke="#fff"
                                        stroke-width="2" fill="none" />
                                    <circle cx="12" cy="12" r="3" stroke="#fff" stroke-width="2"
                                        fill="none" />
                                </svg>
                                Ver detalle
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

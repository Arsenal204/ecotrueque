<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Reclamaciones recibidas
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div style="max-width:900px; margin:0 auto;">
            @if (session('success'))
                <div
                    style="margin-bottom:1.5rem; padding:1rem; border-radius:0.5rem; background-color:#45F85A; color:#222; font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif

            @forelse ($reclamaciones as $reclamacion)
                <div
                    style="background:#e2cc82; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:1.5rem 1.2rem; margin-bottom:1.5rem; border:1px solid #b6e388;">
                    <p style="margin-bottom:0.5rem;"><strong>Motivo:</strong> {{ $reclamacion->motivo }}</p>
                    <p style="margin-bottom:0.5rem;"><strong>Estado:</strong>
                        <span
                            style="color:{{ $reclamacion->estado_reclamacion === 'pendiente' ? '#b4007c' : ($reclamacion->estado_reclamacion === 'resuelta' ? '#37c047' : '#e10909') }};">
                            {{ ucfirst($reclamacion->estado_reclamacion) }}
                        </span>
                    </p>
                    <p style="margin-bottom:0.5rem;"><strong>Reclamante:</strong> {{ $reclamacion->emisor->name }}</p>
                    <p style="margin-bottom:0.5rem;"><strong>Reclamado:</strong> {{ $reclamacion->reclamado->name }}</p>
                    <a href="{{ route('admin.reclamaciones.show', $reclamacion->id) }}"
                        style="display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.7rem; background:#76a03b; color:#fff; font-weight:700; padding:0.5rem 1.3rem; border-radius:0.5rem; text-decoration:none; font-size:0.98rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                        onmouseover="this.style.background='#45F85A';" onmouseout="this.style.background='#76a03b';">
                        <!-- Icono lupa SVG -->
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7" stroke="#fff" stroke-width="2" />
                            <line x1="16.5" y1="16.5" x2="21" y2="21" stroke="#fff"
                                stroke-width="2" stroke-linecap="round" />
                        </svg>
                        Ver detalles
                    </a>
                </div>
            @empty
                <p style="color:#b4007c; font-size:1.1rem;">No hay reclamaciones registradas.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

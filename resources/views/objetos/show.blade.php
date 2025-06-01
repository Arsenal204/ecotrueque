<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Detalle del objeto
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div style="max-width:900px; margin:0 auto;">
            <div
                style="background:#8dbf48; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#fff;">
                <!-- Galería de imágenes -->
                <div
                    style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.2rem; margin-bottom:2rem;">
                    @forelse ($objeto->imagenes as $imagen)
                        <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}"
                            style="width:100%; height:220px; object-fit:cover; border-radius:0.7rem; background:#fff; box-shadow:0 2px 8px rgba(34,139,34,0.10);"
                            alt="Imagen">
                    @empty
                        <img src="{{ asset('images/placeholder.png') }}"
                            style="width:100%; height:220px; object-fit:cover; border-radius:0.7rem; background:#fff; box-shadow:0 2px 8px rgba(34,139,34,0.10);"
                            alt="Sin imagen">
                    @endforelse
                </div>

                <!-- Información del objeto -->
                <h3 style="font-size:1.3rem; font-weight:700; margin-bottom:0.7rem; color:#fff;">{{ $objeto->titulo }}
                </h3>
                <p style="margin-bottom:0.3rem;"><strong>Estado:</strong> {{ $objeto->estado }}</p>
                <p style="margin-bottom:0.3rem;"><strong>Oferta:</strong> {{ ucfirst($objeto->tipo_oferta) }}</p>
                @php
                    $cat = \App\Models\Categoria::find($objeto->categoria);
                @endphp
                <p style="font-size:0.97rem; color:#f9fafb; margin-bottom:1.2rem;">
                    <strong>Categoría:</strong> {{ $cat?->nombre_categoria ?? 'Sin categoría' }}
                </p>
                <p style="margin-bottom:1.5rem;"><strong>Descripción:</strong><br>{{ $objeto->descripcion }}</p>

                @if (auth()->check() && auth()->id() !== $objeto->usuario)
                    <div style="margin-top:2rem;">
                        <a href="{{ route('intercambios.create', $objeto->id) }}"
                            style="display:inline-flex; align-items:center; gap:0.7rem; background:#ffe066; color:#222; font-weight:700; padding:0.7rem 2rem; border-radius:0.5rem; font-size:1rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                            onmouseover="this.style.background='#ffe9a7';"
                            onmouseout="this.style.background='#ffe066';">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                style="vertical-align:middle;">
                                <path d="M7 7H17V3M17 3L21 7" stroke="#5C3F94" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17 17H7V21M7 21L3 17" stroke="#76a03b" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Solicitar intercambio
                        </a>
                    </div>
                @endif

                <!-- Botón volver -->
                <div style="margin-top:2rem;">
                    <a href="{{ route('objetos.index') }}"
                        style="display:inline-block; padding:0.6rem 1.5rem; background:#94D7FB; color:#222; border-radius:0.5rem; font-weight:600; font-size:1rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                        onmouseover="this.style.background='#b6e388';" onmouseout="this.style.background='#94D7FB';">
                        ← Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

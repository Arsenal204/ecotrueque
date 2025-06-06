<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Detalles de la reclamación
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:900px; margin:0 auto; background:#e2cc82; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem;">
            <div
                style="background:#fff; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:2rem 1.5rem; color:#222;">
                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.7rem; color:#e10909;">Motivo</h3>
                <p style="margin-bottom:1.2rem;">{{ $reclamacion->motivo }}</p>

                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.7rem; color:#5C3F94;">Descripción</h3>
                <p style="margin-bottom:1.2rem;">{{ $reclamacion->descripcion ?? 'No se proporcionó descripción.' }}</p>

                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.7rem; color:#76a03b;">Estado</h3>
                <p style="margin-bottom:1.2rem;">
                    <span
                        style="color:{{ $reclamacion->estado_reclamacion === 'pendiente' ? '#b4007c' : ($reclamacion->estado_reclamacion === 'resuelta' ? '#45F85A' : '#e10909') }};">
                        {{ ucfirst($reclamacion->estado_reclamacion) }}
                    </span>
                </p>

                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.7rem; color:#5C3F94;">Fecha de reclamación
                </h3>
                <p style="margin-bottom:1.2rem;">{{ $reclamacion->fecha_reclamacion->format('d/m/Y') }}</p>

                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.7rem; color:#76a03b;">Usuario reclamado
                </h3>
                <p style="margin-bottom:1.2rem;">{{ $reclamacion->usuarioReclamado->name ?? 'Desconocido' }}</p>

                @if ($reclamacion->imagenes && $reclamacion->imagenes->count() > 0)
                    <h3
                        style="font-size:1.1rem; font-weight:700; margin-bottom:0.7rem; color:#e10909; margin-top:2rem;">
                        Imágenes adjuntas</h3>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.2rem;">
                        @foreach ($reclamacion->imagenes as $imagen)
                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}"
                                style="width: 220px; height: 220px; object-fit:cover; border-radius:0.7rem; background:#fff; box-shadow:0 2px 8px rgba(34,139,34,0.10);"
                                alt="Imagen de la reclamación">
                        @endforeach
                    </div>
                @endif

            </div>
            <div style="margin-top:2rem; text-align:left;">
                <a href="{{ route('reclamaciones.pdf', $reclamacion->id) }}"
                    style="display:inline-block; padding:0.6rem 1.5rem; background:#FFEA27; color:#222; border-radius:0.5rem; font-weight:600; font-size:1rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                    onmouseover="this.style.background='#ffe066';" onmouseout="this.style.background='#FFEA27';">
                    Descargar PDF
                </a>
                <br>

                <a href="{{ route('reclamaciones.index') }}"
                    style=" margin-top:1rem; display:inline-block; padding:0.6rem 1.5rem; background:#FFEA27; color:#222; border-radius:0.5rem; font-weight:600; font-size:1rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                    onmouseover="this.style.background='#ffe066';" onmouseout="this.style.background='#FFEA27';">
                    Volver a mis reclamaciones
                </a>

            </div>
        </div>
</x-app-layout>

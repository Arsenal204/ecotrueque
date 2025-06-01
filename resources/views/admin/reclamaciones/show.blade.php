<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Detalles de la reclamación
        </h2>
    </x-slot>

    <div style="background-color: #e2cc82; min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:900px; margin:0 auto; background:#fffbe6; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#222;">
            <h3 style="font-size:1.15rem; font-weight:700; margin-bottom:1.2rem;">Información de la reclamación</h3>

            <p style="margin-bottom:0.5rem;"><strong>Motivo:</strong> {{ $reclamacion->motivo }}</p>
            <p style="margin-bottom:0.5rem;"><strong>Descripción:</strong>
                {{ $reclamacion->descripcion ?? 'Sin descripción' }}</p>
            <p style="margin-bottom:0.5rem;"><strong>Estado:</strong>
                <span
                    style="color:{{ $reclamacion->estado_reclamacion === 'pendiente' ? '#b4007c' : ($reclamacion->estado_reclamacion === 'resuelta' ? '#45F85A' : '#e10909') }};">
                    {{ ucfirst($reclamacion->estado_reclamacion) }}
                </span>
            </p>
            <p style="margin-bottom:0.5rem;"><strong>Fecha de reclamación:</strong> {{ $reclamacion->fecha_reclamacion }}
            </p>

            <hr style="margin:2rem 0; border:0; border-top:1px solid #e2cc82;">

            <h4 style="font-weight:700; margin-bottom:0.7rem;">Usuarios implicados</h4>
            <p style="margin-bottom:0.5rem;"><strong>Reclamante:</strong> {{ $reclamacion->emisor->name }}</p>
            <p style="margin-bottom:0.5rem;"><strong>Reclamado:</strong> {{ $reclamacion->reclamado->name }}</p>

            <hr style="margin:2rem 0; border:0; border-top:1px solid #e2cc82;">

            <h4 style="font-weight:700; margin-bottom:0.7rem;">Intercambio relacionado</h4>
            @if ($reclamacion->intercambio)
                <p style="margin-bottom:0.5rem;"><strong>Fecha:</strong> {{ $reclamacion->intercambio->fecha }}</p>
                <p style="margin-bottom:0.5rem;"><strong>Estado:</strong>
                    {{ ucfirst($reclamacion->intercambio->estado) }}</p>
                <div
                    style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem; margin-top:1.2rem;">
                    <div>
                        <h5 style="font-weight:700; margin-bottom:0.5rem;">Objeto ofrecido:</h5>
                        <img src="{{ $reclamacion->intercambio->objetoEmisor->imagenes->first() ? asset('storage/' . $reclamacion->intercambio->objetoEmisor->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                            alt="Objeto ofrecido"
                            style="width: 220px; height: 220px; object-fit:cover; border-radius:0.7rem; background:#fff; margin-bottom:0.5rem; box-shadow:0 2px 8px rgba(34,139,34,0.10);" />
                        <p>{{ $reclamacion->intercambio->objetoEmisor->titulo }}</p>
                    </div>
                    <div>
                        <h5 style="font-weight:700; margin-bottom:0.5rem;">Objeto recibido:</h5>
                        <img src="{{ $reclamacion->intercambio->objetoReceptor->imagenes->first() ? asset('storage/' . $reclamacion->intercambio->objetoReceptor->imagenes->first()->ruta_imagen) : asset('images/stock2.jpg') }}"
                            alt="Objeto recibido"
                            style="width: 220px; height: 220px; object-fit:cover; border-radius:0.7rem; background:#fff; margin-bottom:0.5rem; box-shadow:0 2px 8px rgba(34,139,34,0.10);" />
                        <p>{{ $reclamacion->intercambio->objetoReceptor->titulo }}</p>
                    </div>
                    @if ($reclamacion->ruta_imagen)
                        <div>
                            <h5 style="font-weight:700; margin-bottom:0.5rem;">Imagen subida por el usuario:</h5>
                            <img src="{{ asset('storage/' . $reclamacion->ruta_imagen) }}"
                                alt="Imagen de la reclamación"
                                style="width: 220px; height: 220px; object-fit:cover; border-radius:0.7rem; background:#fff; margin-bottom:0.5rem; box-shadow:0 2px 8px rgba(34,139,34,0.10);" />
                        </div>
                    @endif
                </div>
            @else
                <p>No hay intercambio asociado.</p>
            @endif

            <hr style="margin:2rem 0; border:0; border-top:1px solid #e2cc82;">

            <!-- Formulario de respuesta del admin -->
            <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1.2rem;">Resolución del administrador</h3>
            <form action="{{ route('admin.reclamaciones.resolver', $reclamacion->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="margin-bottom:1.2rem;">
                    <label for="resolucion_admin" style="display:block; margin-bottom:0.5rem; font-weight:600;">Texto de
                        resolución:</label>
                    <textarea name="resolucion_admin" id="resolucion_admin" rows="4"
                        style="width:100%; border-radius:0.5rem; padding:0.7rem; color:#222; font-size:1rem; border:1px solid #ccc; background:#f9fafb;"
                        required>{{ old('resolucion_admin', $reclamacion->resolucion_admin) }}</textarea>
                </div>

                <div style="margin-bottom:1.2rem;">
                    <label for="archivos_admin" style="display:block; margin-bottom:0.5rem; font-weight:600;">Adjuntar
                        archivo (opcional):</label>
                    <input type="file" name="archivos_admin"
                        style="width:100%; padding:0.4rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222;">
                    @if ($reclamacion->archivos_admin)
                        <p style="font-size:0.97rem; margin-top:0.5rem;">
                            Archivo actual:
                            <a href="{{ asset('storage/' . $reclamacion->archivos_admin) }}"
                                style="color:#5C3F94; text-decoration:underline;" target="_blank">Ver archivo</a>
                        </p>
                    @endif
                </div>

                <div style="margin-bottom:1.2rem;">
                    <label for="estado_reclamacion"
                        style="display:block; margin-bottom:0.5rem; font-weight:600;">Cambiar estado:</label>
                    <select name="estado_reclamacion" id="estado_reclamacion"
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                        <option value="pendiente"
                            {{ $reclamacion->estado_reclamacion == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en revisión"
                            {{ $reclamacion->estado_reclamacion == 'en revisión' ? 'selected' : '' }}>En revisión
                        </option>
                        <option value="resuelta"
                            {{ $reclamacion->estado_reclamacion == 'resuelta' ? 'selected' : '' }}>Resuelta</option>
                        <option value="rechazada"
                            {{ $reclamacion->estado_reclamacion == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                    </select>
                </div>

                <button type="submit"
                    style="background:#FFEA27; color:#222; font-weight:700; padding:0.7rem 2rem; border-radius:0.5rem; border:none; font-size:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s; cursor:pointer; display:inline-flex; align-items:center; gap:0.5rem;"
                    onmouseover="this.style.background='#ffe066';" onmouseout="this.style.background='#FFEA27';">
                    <!-- SVG disquete -->
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke="#222" stroke-width="2"
                            fill="#fff" />
                        <rect x="7" y="15" width="10" height="4" rx="1" stroke="#222" stroke-width="2"
                            fill="#FFEA27" />
                        <rect x="7" y="5" width="6" height="4" rx="1" stroke="#222" stroke-width="2"
                            fill="#ffe066" />
                        <path d="M17 3v6a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2V3" stroke="#222" stroke-width="2" />
                    </svg>
                    Guardar resolución
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

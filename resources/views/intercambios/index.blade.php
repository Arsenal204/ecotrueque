<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Mis intercambios
        </h2>
    </x-slot>

    <div style="background:#e2cc82; min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:950px; margin:0 auto; background-color:#ebdba7; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem;">

            @if (session('success'))
                <div
                    style="margin-bottom:1.5rem; padding:1rem; border-radius:0.5rem; background-color:#45F85A; color:#222; font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif

            <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1.5rem;">Intercambios recibidos</h3>

            @php
                $enviados = $intercambios->where('id_usuario_emisor', auth()->id());
                $recibidos = $intercambios->where('id_usuario_receptor', auth()->id());
            @endphp

            @forelse ($recibidos as $inter)
                <div
                    style="background:#b6e388; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:1.5rem 1.2rem; margin-bottom:1.5rem;">
                    <div style="display:flex; flex-wrap:wrap; gap:2rem; align-items:center;">
                        <!-- Imagen del objeto que ofrecen -->
                        <div style="flex:1; min-width:180px; text-align:center;">
                            <img src="{{ $inter->objetoEmisor->imagenes->first()
                                ? asset('storage/' . $inter->objetoEmisor->imagenes->first()->ruta_imagen)
                                : asset('images/stock1.jpg') }}"
                                alt="Imagen objeto ofrecido"
                                style="width:120px; height:90px; object-fit:cover; border-radius:0.7rem; border:1px solid #e2cc82; background:#fff;">
                            <p style="margin-top:0.5rem; font-size:0.97rem; font-weight:600;">Te ofrecen</p>
                        </div>
                        <!-- Imagen de tu objeto -->
                        <div style="flex:1; min-width:180px; text-align:center;">
                            <img src="{{ $inter->objetoReceptor->imagenes->first()
                                ? asset('storage/' . $inter->objetoReceptor->imagenes->first()->ruta_imagen)
                                : asset('images/stock2.jpg') }}"
                                alt="Imagen de tu objeto"
                                style="width:120px; height:90px; object-fit:cover; border-radius:0.7rem; border:1px solid #e2cc82; background:#fff;">
                            <p style="margin-top:0.5rem; font-size:0.97rem; font-weight:600;">Tu objeto</p>
                        </div>
                        <!-- Información y botones -->
                        <div style="flex:2; min-width:220px;">
                            <p><strong>De:</strong> {{ $inter->objetoEmisor->usuario->name ?? 'Usuario desconocido' }}
                            </p>
                            <p><strong>Objeto ofrecido:</strong> {{ $inter->objetoEmisor->titulo }}</p>
                            <p><strong>Tu objeto:</strong> {{ $inter->objetoReceptor->titulo }}</p>
                            <p><strong>Estado:</strong> {{ ucfirst($inter->estado) }}</p>
                            <p style="font-size:0.93rem; color:#5C3F94; margin-top:0.3rem;">Fecha: {{ $inter->fecha }}
                            </p>

                            @if ($inter->estado === 'pendiente')
                                <div style="display:flex; gap:0.7rem; margin-top:1rem;">
                                    <form action="{{ route('intercambios.confirmar', $inter->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            style="background:#45F85A; color:#222; font-weight:700; padding:0.5rem 1.2rem; border-radius:0.5rem; border:none; font-size:0.98rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s; cursor:pointer;"
                                            onmouseover="this.style.background='#76a03b'; this.style.color='#fff';"
                                            onmouseout="this.style.background='#45F85A'; this.style.color='#222';">
                                            Confirmar
                                        </button>
                                    </form>
                                    <form action="{{ route('intercambios.cancelar', $inter->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            style="background:#e10909; color:#fff; font-weight:700; padding:0.5rem 1.2rem; border-radius:0.5rem; border:none; font-size:0.98rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s; cursor:pointer;"
                                            onmouseover="this.style.background='#b4007c';"
                                            onmouseout="this.style.background='#e10909';">
                                            Rechazar
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if ($inter->estado === 'confirmado')
                                <!-- Botón para abrir el modal de reclamación -->
                                <button type="button"
                                    style="margin-top:1rem; background:#e10909; color:#fff; font-weight:700; padding:0.5rem 1.2rem; border-radius:0.5rem; border:none; font-size:0.98rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s; cursor:pointer;"
                                    data-bs-toggle="modal" data-bs-target="#reclamarModal-{{ $inter->id }}"
                                    onmouseover="this.style.background='#b4007c';"
                                    onmouseout="this.style.background='#e10909';">
                                    Hacer una reclamación
                                </button>
                                <!-- Modal de Reclamación -->
                                <div class="modal fade" id="reclamarModal-{{ $inter->id }}" tabindex="-1"
                                    aria-labelledby="reclamarModalLabel-{{ $inter->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"
                                            style="background:rgba(255,255,255,0.97); border-radius:1rem; box-shadow:0 8px 32px 0 rgba(34,139,34,0.15); border:1px solid #b6e388;">
                                            <div class="modal-header"
                                                style="border-bottom:none; background:#e2cc82; border-radius:1rem 1rem 0 0;">
                                                <h5 class="modal-title" id="reclamarModalLabel-{{ $inter->id }}"
                                                    style="font-size:1.3rem; font-weight:700; color:#e10909;">
                                                    Enviar reclamación
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"
                                                    style="background:none; border:none; font-size:1.5rem; color:#e10909;">&times;</button>
                                            </div>
                                            <form method="POST" action="{{ route('reclamaciones.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_intercambio"
                                                    value="{{ $inter->id }}">
                                                <input type="hidden" name="id_usuario_reclamado"
                                                    value="{{ $inter->id_usuario_emisor === Auth::id() ? $inter->id_usuario_receptor : $inter->id_usuario_emisor }}">
                                                <div class="modal-body" style="padding:2rem;">
                                                    <div style="margin-bottom:1.2rem;">
                                                        <label for="motivo-{{ $inter->id }}"
                                                            style="display:block; font-weight:600; color:#e10909; margin-bottom:0.3rem;">Motivo</label>
                                                        <input type="text" name="motivo"
                                                            id="motivo-{{ $inter->id }}" required
                                                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                                                            onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                                                            onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
                                                    </div>
                                                    <div style="margin-bottom:1.2rem;">
                                                        <label for="descripcion-{{ $inter->id }}"
                                                            style="display:block; font-weight:600; color:#e10909; margin-bottom:0.3rem;">Descripción</label>
                                                        <textarea name="descripcion" id="descripcion-{{ $inter->id }}" rows="3" required
                                                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; resize:vertical; transition:box-shadow 0.2s, border-color 0.2s;"
                                                            onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                                                            onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';"></textarea>
                                                    </div>
                                                    <div style="margin-bottom:1.2rem;">
                                                        <label for="imagen-{{ $inter->id }}"
                                                            style="display:block; font-weight:600; color:#e10909; margin-bottom:0.3rem;">
                                                            Subir imagen del producto (opcional)
                                                        </label>
                                                        <input type="file" name="imagen"
                                                            id="imagen-{{ $inter->id }}" accept="image/*"
                                                            style="width:100%; padding:0.3rem 0.2rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222;">
                                                    </div>
                                                </div>
                                                <div class="modal-footer"
                                                    style="border-top:none; background:#f9fafb; border-radius:0 0 1rem 1rem; display:flex; justify-content:flex-end; gap:1rem; padding:1rem 2rem;">
                                                    <button type="button" data-bs-dismiss="modal"
                                                        style="background:#ccc; color:#222; border:none; border-radius:0.5rem; padding:0.5rem 1.5rem; font-weight:600; transition:background 0.2s;"
                                                        onmouseover="this.style.background='#b6e388';"
                                                        onmouseout="this.style.background='#ccc';">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit"
                                                        style="background:#e10909; color:#fff; border:none; border-radius:0.5rem; padding:0.5rem 1.5rem; font-weight:600; transition:background 0.2s; display:inline-flex; align-items:center; gap:0.4rem;"
                                                        onmouseover="this.style.background='#b4007c';"
                                                        onmouseout="this.style.background='#e10909';">
                                                        <!-- Icono advertencia SVG -->
                                                        <svg width="18" height="18" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <circle cx="12" cy="12" r="10"
                                                                stroke="#fff" stroke-width="2" />
                                                            <rect x="11" y="7" width="2" height="7"
                                                                rx="1" fill="#fff" />
                                                            <rect x="11" y="16" width="2" height="2"
                                                                rx="1" fill="#fff" />
                                                        </svg>
                                                        Enviar Reclamación
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p style="color:#b4007c; font-size:1.1rem;">No has recibido solicitudes de intercambio.</p>
            @endforelse

            <h3 style="font-size:1.1rem; font-weight:700; margin:2.5rem 0 1.5rem 0;">Intercambios realizados</h3>
            @php
                $realizados = $intercambios->filter(function ($i) {
                    return $i->estado === 'confirmado';
                });
            @endphp

            @forelse ($realizados as $inter)
                <div
                    style="background:#e2cc82; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:1.2rem 1rem; margin-bottom:1.2rem;">
                    <p><strong>Tú:</strong>
                        {{ $inter->objetoEmisor->usuario === Auth::id() ? 'Intercambiaste' : 'Recibiste' }}</p>
                    <p><strong>Objeto tuyo:</strong>
                        {{ $inter->objetoEmisor->usuario === Auth::id() ? $inter->objetoEmisor->titulo : $inter->objetoReceptor->titulo }}
                    </p>
                    <p><strong>Objeto del otro usuario:</strong>
                        {{ $inter->objetoEmisor->usuario === Auth::id() ? $inter->objetoReceptor->titulo : $inter->objetoEmisor->titulo }}
                    </p>
                    <p style="font-size:0.93rem; color:#5C3F94; margin-top:0.3rem;">Fecha: {{ $inter->fecha }}</p>
                </div>
            @empty
                <p style="color:#b4007c; font-size:1.1rem;">Aún no has completado intercambios.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>

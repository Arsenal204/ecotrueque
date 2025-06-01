<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.5rem; font-weight:700; color:#fff;">
            {{ __('Editar objeto') }}
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:2rem 0;">
        <div
            style="max-width:600px; margin:0 auto; background:#e2cc82; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2rem 2.5rem; color:#222;">
            @if (session('success'))
                <div
                    style="margin-bottom:1.5rem; padding:1rem; border-radius:0.5rem; background-color:#45F85A; color:#222; font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario de edición -->
            <form method="POST" action="{{ route('objetos.update', $objeto) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div style="margin-bottom:1.2rem;">
                    <label for="titulo"
                        style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Título</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $objeto->titulo) }}"
                        required
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
                </div>

                <!-- Descripción -->
                <div style="margin-bottom:1.2rem;">
                    <label for="descripcion"
                        style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3"
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem; resize:vertical; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">{{ old('descripcion', $objeto->descripcion) }}</textarea>
                </div>

                <!-- Estado -->
                <div style="margin-bottom:1.2rem;">
                    <label for="estado"
                        style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Estado</label>
                    <input type="text" name="estado" id="estado" value="{{ old('estado', $objeto->estado) }}"
                        required
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
                </div>

                <!-- Tipo de oferta -->
                <div style="margin-bottom:1.2rem;">
                    <label for="tipo_oferta"
                        style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Tipo de
                        oferta</label>
                    <select name="tipo_oferta" id="tipo_oferta"
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                        <option value="donación" {{ $objeto->tipo_oferta == 'donación' ? 'selected' : '' }}>Donación
                        </option>
                        <option value="trueque" {{ $objeto->tipo_oferta == 'trueque' ? 'selected' : '' }}>Trueque
                        </option>
                    </select>
                </div>

                <!-- Categoría -->
                <div style="margin-bottom:1.2rem;">
                    <label for="categoria"
                        style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Categoría</label>
                    <select name="categoria" id="categoria"
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $objeto->categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Imágenes actuales -->


                <!-- Botón de guardar -->
                <div style="text-align:right;">
                    <button type="submit"
                        style="background-color: #FFEA27; color:#222; font-weight:700; font-size:1rem; padding:0.7rem 2rem; border-radius:0.5rem; border:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;">
                        Guardar cambios
                    </button>
                </div>
            </form>
            <div style="margin-bottom:1.2rem;">
                <label style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Imágenes
                    actuales</label>
                <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:1rem;">
                    @foreach ($objeto->imagenes as $imagen)
                        <div style="position:relative;">
                            <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}"
                                style="width:100%; height:110px; object-fit:cover; border-radius:0.5rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); border:1px solid #ddd;">
                            <form action="{{ route('galerias.destroy', $imagen) }}" method="POST"
                                style="position:absolute; top:8px; right:8px;"
                                onsubmit="return confirm('¿Eliminar esta imagen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="background:#e10909; color:#fff; border:none; border-radius:0.5rem; padding:0.3rem 0.6rem; font-size:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); display:flex; align-items:center; gap:0.2rem;">
                                    <!-- Papelera SVG -->
                                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24"
                                        style="vertical-align:middle;">
                                        <rect x="5" y="7" width="14" height="12" rx="2" stroke="#fff"
                                            stroke-width="2" fill="none" />
                                        <path d="M3 7h18" stroke="#fff" stroke-width="2" />
                                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#fff"
                                            stroke-width="2" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div style="font-size:0.95rem; color:#e10909; margin-top:0.5rem;">
                    Si eliminas la última imagen, se borrará el objeto.
                </div>
            </div>

            <!-- Subir nuevas imágenes -->
            <div style="margin-bottom:2rem;">
                <label for="imagenes"
                    style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Añadir nuevas
                    imágenes</label>
                <input type="file" name="imagenes[]" id="imagenes" multiple
                    style="width:100%; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222;">
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>


    <div style="max-width:900px; margin:2rem auto 2.5rem auto;">
        <!-- Bienvenida personalizada -->
        <div
            style="background:rgba(255,255,255,0.93); border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:1.5rem 2rem; margin-bottom:1.5rem; text-align:center; border:1px solid #b6e388;">
            <h2 style="font-size:2rem; font-weight:800; color:#76a03b; margin-bottom:0.5rem;">
                ¡Hola, {{ Auth::user()->name }}!
            </h2>
            <p style="color:#444; font-size:1.1rem;">
                Bienvenido a tu panel de <span style="color:#5C3F94; font-weight:600;">EcoTrueque</span>.<br>
                Gestiona tus objetos, descubre productos y ayuda a crear un mundo más sostenible.
            </p>
        </div>
        <!-- Botón destacado para publicar -->
        <div style="text-align:center; margin-bottom:1.5rem;">
            <button type="button"
                style="background:#76a03b; color:#fff; font-weight:700; font-size:1.1rem; padding:0.8rem 2.5rem; border-radius:0.5rem; border:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s; cursor:pointer;"
                data-bs-toggle="modal" data-bs-target="#crearObjetoModal" onmouseover="this.style.background='#b6e388';"
                onmouseout="this.style.background='#76a03b';">
                + Publicar nuevo objeto
            </button>
        </div>
        <!-- Contenido principal -->
        <div class="container">
            <h3 class="text-2xl font-semibold text-black text-center mb-4">Tus objetos</h3>

            <!-- Carrusel -->
            <div x-data="{
                active: 0,
                slides: [
                    @if ($imagenes && count($imagenes) > 0) {!! collect($imagenes)->map(fn($img) => "'" . asset('storage/' . $img->ruta_imagen) . "'")->implode(',') !!} @endif
                ]
            }" class="relative max-w-2xl mx-auto mt-6">

                <!-- Imagen actual -->
                <div class="overflow-hidden  shadow-md">
                    <img :src="slides[active]"
                        class="mx-auto  object-cover rounded-md shadow-md transition-all duration-500"
                        style="width: 266px; height: 266px;">
                </div>

                <!-- Controles -->
                <div class="absolute inset-0 flex items-center justify-between px-4">
                    <button @click="active = (active - 1 + slides.length) % slides.length"
                        class="bg-white bg-opacity-70 px-3 py-1 rounded">‹</button>
                    <button @click="active = (active + 1) % slides.length"
                        class="bg-white bg-opacity-70 px-3 py-1 rounded">›</button>
                </div>

                <!-- Indicadores -->
                <div class="flex justify-center space-x-2 mt-2">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="active = index"
                            :class="{ 'bg-blue-600': active === index, 'bg-gray-400': active !== index }"
                            class="w-3 h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>

            <h3 class="text-xl text-black mt-10 text-center">Productos que te pueden interesar</h3>
            <div x-data="{
                active: 0,
                objetos: {{ Js::from(
                    $sugerencias->map(function ($objeto) {
                        return [
                            'id' => $objeto->id,
                            'titulo' => $objeto->titulo,
                            'descripcion' => Str::limit($objeto->descripcion, 80),
                            'imagen' => $objeto->imagenes->first()
                                ? asset('storage/' . $objeto->imagenes->first()->ruta_imagen)
                                : asset('images/stock1.jpg'),
                            'url' => route('objetos.show', $objeto->id),
                        ];
                    }),
                ) }},
            }" class="relative w-full max-w-xl mx-auto mt-6">

                <div class="overflow-hidden rounded-lg shadow-md bg-white dark:bg-gray-800">
                    <template x-if="objetos.length">
                        <div class="p-4 text-center">
                            <img :src="objetos[active].imagen"
                                class="mx-auto h-32 w-64 object-cover rounded-md shadow border border-gray-300">
                            <h3 class="mt-4 text-lg font-bold text-gray-800 dark:text-white"
                                x-text="objetos[active].titulo"></h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300" x-text="objetos[active].descripcion">
                            </p>
                            <a x-bind:href="objetos[active].url"
                                class="inline-block mt-3 text-blue-600 dark:text-blue-400 hover:underline text-sm z-10 relative">
                                Ver más
                            </a>

                        </div>
                    </template>
                </div>

                <!-- Controles -->
                <div class="absolute inset-0 flex items-center justify-between px-4">
                    <button @click="active = (active - 1 + objetos.length) % objetos.length"
                        class="bg-white bg-opacity-50 hover:bg-opacity-100 px-2 py-1 rounded">
                        ‹
                    </button>
                    <button @click="active = (active + 1) % objetos.length"
                        class="bg-white bg-opacity-50 hover:bg-opacity-100 px-2 py-1 rounded">
                        ›
                    </button>
                </div>

                <!-- Indicadores -->
                <div class="flex justify-center space-x-2 mt-2">
                    <template x-for="(objeto, index) in objetos" :key="index">
                        <button @click="active = index"
                            :class="{ 'bg-blue-600': active === index, 'bg-gray-400': active !== index }"
                            class="w-3 h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>

        </div>

        <!-- Consejo ecológico -->
        @php
            $tips = [
                'Recuerda que donar es mejor que tirar.',
                '¡El trueque ayuda a reducir residuos y cuidar el planeta!',
                'Publica fotos claras para que tus objetos encuentren un nuevo hogar.',
                'Revisa tus objetos publicados y actualiza su estado si ya no están disponibles.',
            ];
            $tip = $tips[array_rand($tips)];
        @endphp
        <div
            style="background:#f9fafb; border-left:5px solid #76a03b; border-radius:0.5rem; padding:1rem 1.5rem; margin-bottom:1.5rem; color:#444; font-style:italic;">
            🌱 Consejo EcoTrueque: <span style="font-weight:600;">{{ $tip }}</span>
        </div>


        <hr style="border:none; border-top:2px solid #e2cc82; margin:2rem 0;">
    </div>


    <!-- Modal para crear objeto -->
    <div class="modal fade" id="crearObjetoModal" tabindex="-1" aria-labelledby="crearObjetoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"
                style="background:rgba(255,255,255,0.97); border-radius:1rem; box-shadow:0 8px 32px 0 rgba(34,139,34,0.15); border:1px solid #b6e388;">
                <div class="modal-header" style="border-bottom:none; background:#e2cc82; border-radius:1rem 1rem 0 0;">
                    <h5 class="modal-title" style="font-size:1.3rem; font-weight:700; color:#5C3F94;">Publicar nuevo
                        objeto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"
                        style="background:none; border:none; font-size:1.5rem; color:#5C3F94;">&times;</button>
                </div>
                <form method="POST" action="{{ route('objetos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" style="padding:2rem;">
                        <div style="margin-bottom:1.2rem;">
                            <label for="titulo"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Título</label>
                            <input type="text" name="titulo" required
                                style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                                onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                                onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label for="descripcion"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Descripción</label>
                            <textarea name="descripcion" rows="3"
                                style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; resize:vertical; transition:box-shadow 0.2s, border-color 0.2s;"
                                onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                                onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';"></textarea>
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label for="estado"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Estado</label>
                            <input type="text" name="estado" required
                                style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                                onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                                onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label for="tipo_oferta"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Tipo
                                de
                                oferta</label>
                            <select name="tipo_oferta"
                                style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem;">
                                <option value="trueque">Trueque</option>
                            </select>
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label for="categoria"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Categoría
                                existente</label>
                            <select name="categoria" id="categoria"
                                style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem;">
                                <option value="">-- Selecciona una categoría existente --</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label for="nueva_categoria"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">O crea
                                una
                                nueva categoría</label>
                            <input type="text" name="nueva_categoria" id="nueva_categoria"
                                placeholder="Ej: Juguetes, Herramientas..."
                                style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                                onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                                onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
                        </div>
                        <div style="margin-bottom:1.2rem;">
                            <label for="imagenes"
                                style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Imágenes</label>
                            <input type="file" name="imagenes[]" multiple
                                style="width:100%; padding:0.3rem 0.2rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222;">
                        </div>
                    </div>
                    <div class="modal-footer"
                        style="border-top:none; background:#f9fafb; border-radius:0 0 1rem 1rem; display:flex; justify-content:flex-end; gap:1rem; padding:1rem 2rem;">
                        <button type="button" data-bs-dismiss="modal"
                            style="background:#ccc; color:#222; border:none; border-radius:0.5rem; padding:0.5rem 1.5rem; font-weight:600; transition:background 0.2s;"
                            onmouseover="this.style.background='#b6e388';" onmouseout="this.style.background='#ccc';">
                            Cancelar
                        </button>
                        <button type="submit"
                            style="background:#5C3F94; color:#fff; border:none; border-radius:0.5rem; padding:0.5rem 1.5rem; font-weight:600; transition:background 0.2s;"
                            onmouseover="this.style.background='#76a03b';"
                            onmouseout="this.style.background='#5C3F94';">
                            Publicar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

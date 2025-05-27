<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Bienvenido a EcoTrueque
        </h2>
    </x-slot>

    <!-- Barra de navegación -->
    <nav class="bg-[#5C3F94] text-white py-3 px-4 shadow mb-5">
        <div class="container d-flex justify-content-between">
            <div>
                <a href="{{ route('dashboard') }}" class="text-white me-4">Inicio</a>
                <a href="{{ route('objetos.index') }}" class="text-white me-4">Mis Objetos</a>
            </div>
            <div>
                <button type="button" class="btn btn-warning text-dark" data-bs-toggle="modal"
                    data-bs-target="#crearObjetoModal">
                    Añadir Producto
                </button>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container">
        <h3 class="text-2xl font-semibold text-white text-center mb-4">Tus objetos</h3>

        <!-- Carrusel -->
        <div x-data="{
            active: 0,
            slides: [
                @if ($imagenes && count($imagenes) > 0) {!! collect($imagenes)->map(fn($img) => "'" . asset('storage/' . $img->ruta_imagen) . "'")->implode(',') !!}
                @else
                    '{{ asset('images/stock1.jpg') }}',
                    '{{ asset('images/stock2.jpg') }}',
                    '{{ asset('images/stock3.jpg') }}' @endif
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

        <h3 class="text-xl text-white mt-10 text-center">Productos que te pueden interesar</h3>
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
                        <p class="text-sm text-gray-600 dark:text-gray-300" x-text="objetos[active].descripcion"></p>
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

    <!-- Modal para crear objeto -->
    <div class="modal fade" id="crearObjetoModal" tabindex="-1" aria-labelledby="crearObjetoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Publicar nuevo objeto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form method="POST" action="{{ route('objetos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" name="estado" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_oferta" class="form-label">Tipo de oferta</label>
                            <select class="form-select" name="tipo_oferta">
                                <option value="donación">Donación</option>
                                <option value="trueque">Trueque</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Categoría existente
                            </label>
                            <select name="categoria" id="categoria" class="mt-1 block w-full rounded border-gray-300">
                                <option value="">-- Selecciona una categoría existente --</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="nueva_categoria" class="block text-sm font-medium text-gray-700 ">
                                O crea una nueva categoría
                            </label>
                            <input type="text" name="nueva_categoria" id="nueva_categoria"
                                placeholder="Ej: Juguetes, Herramientas..."
                                class="mt-1 block w-full rounded border-gray-300 ">
                        </div>

                        <div class="mb-3">
                            <label for="imagenes" class="form-label">Imágenes</label>
                            <input class="form-control" type="file" name="imagenes[]" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>

    <!-- Barra de navegación horizontal -->
    <nav class="bg-blue-800 text-white flex justify-center space-x-8 py-3 mt-4">
        <a href="{{ route('dashboard') }}" class="uppercase text-sm hover:underline">Inicio</a>
        <a href="{{ route('objetos.index') }}" class="uppercase text-sm hover:underline">Mis Productos</a>
        <a href="{{ route('objetos.create') }}"
            class="uppercase text-sm hover:underline font-semibold text-yellow-300">Añadir Producto</a>
        <a href="#" class="uppercase text-sm hover:underline">Otra sección</a>
    </nav>


    <!-- Contenido principal centrado -->
    <div class="flex flex-col items-center justify-center mt-20 space-y-8 mt-4">
        <h1 class="text-4xl font-bold text-white">Tus Productos</h1>
        <!-- Carrusel de productos -->
        <div x-data="{
            active: 0,
            slides: [
                @if ($imagenes && count($imagenes) > 0) @foreach ($imagenes as $img)
            '{{ asset('storage/' . $img->ruta_imagen) }}',
        @endforeach
    @else
        '{{ asset('images/stock1.jpg') }}',
        '{{ asset('images/stock2.jpg') }}',
        '{{ asset('images/stock3.jpg') }}' @endif
            ]
        }" class="relative w-full max-w-2xl mx-auto mt-6">

            <!-- Imagen actual -->
            <div class="overflow-hidden rounded-lg shadow-md">
                <img :src="slides[active]"
                    class="mx-auto w-50  h-20 object-cover rounded-md shadow-md transition-all duration-500">
            </div>

            <!-- Controles -->
            <div class="absolute inset-0 flex items-center justify-between px-4">
                <button @click="active = (active - 1 + slides.length) % slides.length"
                    class="bg-white bg-opacity-50 hover:bg-opacity-100 px-2 py-1 rounded">
                    ‹
                </button>
                <button @click="active = (active + 1) % slides.length"
                    class="bg-white bg-opacity-50 hover:bg-opacity-100 px-2 py-1 rounded">
                    ›
                </button>
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


        <h2 class="text-2xl font-semibold text-white">
            Productos que te pueden interesar
        </h2>
    </div>
</x-app-layout>

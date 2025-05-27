<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Explorar objetos de otros usuarios
        </h2>
    </x-slot>

    <div class="py-6 bg-[#AB80E5] min-h-screen">
        <div class="max-w-6xl mx-auto p-6 rounded shadow" style="background-color: #ebdba7;">

            <!-- Filtro por categoría -->
            <form method="GET" action="{{ route('objetos.explorar') }}" class="mb-6 flex items-center gap-4">
                <label for="categoria" class="text-white font-semibold">Filtrar por categoría:</label>
                <select name="categoria" id="categoria" onchange="this.form.submit()" class="p-2 rounded text-black">
                    <option value="">-- Todas --</option>
                    @foreach ($categorias as $cat)
                        <option value="{{ $cat->id }}" {{ $categoriaId == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
                <!-- Filtro por ciudad -->
                <div class="mb-4">
                    <label for="ciudad" class="block text-sm font-medium text-white">Filtrar por ciudad</label>
                    <select name="ciudad" id="ciudad" onchange="this.form.submit()"
                        class="mt-1 block w-full rounded bg-white text-black p-2">
                        <option value="">-- Todas las ciudades --</option>
                        <option value="{{ auth()->user()->ciudad }}"
                            {{ request('ciudad') == auth()->user()->ciudad ? 'selected' : '' }}>
                            Solo en {{ auth()->user()->ciudad }}
                        </option>
                    </select>
                </div>
            </form>



            <!-- Tarjetas de objetos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($objetos as $objeto)
                    <div class=" text-white p-4 rounded shadow" style="background-color: #e2cc82;">
                        <img src="{{ $objeto->imagenes->first() ? asset('storage/' . $objeto->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                            alt="{{ $objeto->titulo }}" class=" h-40 object-cover rounded mb-3"
                            style="width: 266px; height: 266px;">
                        <h3 class="text-lg font-semibold">{{ $objeto->titulo }}</h3>
                        <p class="text-sm">{{ Str::limit($objeto->descripcion, 100) }}</p>
                        @php
                            $cat = \App\Models\Categoria::find($objeto->categoria);
                        @endphp

                        <p class="text-xs text-gray-300">
                            Categoría: {{ $cat?->nombre_categoria ?? 'Sin categoría' }}
                        </p>

                        <a href="{{ route('objetos.show', $objeto) }}"
                            class="inline-block mt-3 bg-[#FFEA27] text-black px-4 py-1 rounded hover:bg-yellow-400 transition">
                            Ver objeto
                        </a>
                    </div>
                @empty
                    <p class="text-white">No se han encontrado objetos.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

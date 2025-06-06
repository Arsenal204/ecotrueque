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
                <label for="categoria" class="text-black font-semibold">Filtrar por categoría:</label>
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
                    <label for="ciudad" class="block text-sm font-medium text-black">Filtrar por ciudad</label>
                    <select name="ciudad" id="ciudad" onchange="this.form.submit()"
                        class="mt-1 block w-full rounded  text-black p-2">
                        <option value="">-- Todas las ciudades --</option>
                        <option value="{{ auth()->user()->ciudad }}"
                            {{ request('ciudad') == auth()->user()->ciudad ? 'selected' : '' }}>
                            Solo en {{ auth()->user()->ciudad }}
                        </option>
                    </select>
                </div>
            </form>

            <!-- Tarjetas de objetos -->
            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2rem;">
                @forelse ($objetos as $objeto)
                    <div
                        style="background-color:#e2cc82; color:#222; padding:1.5rem 1rem; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); display:flex; flex-direction:column; align-items:center; text-align:center;">
                        <img src="{{ $objeto->imagenes->first() ? asset('storage/' . $objeto->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                            alt="{{ $objeto->titulo }}"
                            style="width:220px; height:220px; object-fit:cover; border-radius:0.7rem; background:#fff; box-shadow:0 2px 8px rgba(34,139,34,0.10); margin-bottom:1rem;">
                        <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.5rem;">{{ $objeto->titulo }}</h3>
                        <p style="font-size:0.97rem; margin-bottom:0.5rem;">{{ Str::limit($objeto->descripcion, 100) }}
                        </p>
                        @php
                            $cat = \App\Models\Categoria::find($objeto->categoria);
                        @endphp
                        <p style="font-size:0.92rem; color:#5C3F94; margin-bottom:1rem;">
                            Categoría: {{ $cat?->nombre_categoria ?? 'Sin categoría' }}
                        </p>
                        <a href="{{ route('objetos.show', $objeto) }}"
                            style="display:inline-block; margin-top:auto; background:#ffe066; color:#222; padding:0.5rem 1.3rem; border-radius:0.5rem; font-weight:600; font-size:0.98rem; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s;"
                            onmouseover="this.style.background='#ffe9a7';"
                            onmouseout="this.style.background='#ffe066';">
                            Ver objeto
                        </a>
                    </div>
                @empty
                    <p style="color:#b4007c; text-align:center;">No se han encontrado objetos.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

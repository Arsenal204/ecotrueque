<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Editar objeto') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #AB80E5;">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 p-6 rounded shadow text-black" style="background-color: #B4007C;">

            @if (session('success'))
                <div class="mb-4 p-3 rounded" style="background-color: #45F85A; color: black;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario de edición -->
            <form method="POST" action="{{ route('objetos.update', $objeto) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium">Título</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $objeto->titulo) }}"
                        required class="mt-1 block w-full rounded bg-white text-black p-2">
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded bg-white text-black p-2">{{ old('descripcion', $objeto->descripcion) }}</textarea>
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium">Estado</label>
                    <input type="text" name="estado" id="estado" value="{{ old('estado', $objeto->estado) }}"
                        required class="mt-1 block w-full rounded bg-white text-black p-2">
                </div>

                <!-- Tipo de oferta -->
                <div class="mb-4">
                    <label for="tipo_oferta" class="block text-sm font-medium">Tipo de oferta</label>
                    <select name="tipo_oferta" id="tipo_oferta"
                        class="mt-1 block w-full rounded bg-white text-black p-2">
                        <option value="donación" {{ $objeto->tipo_oferta == 'donación' ? 'selected' : '' }}>Donación
                        </option>
                        <option value="trueque" {{ $objeto->tipo_oferta == 'trueque' ? 'selected' : '' }}>Trueque
                        </option>
                    </select>
                </div>

                <!-- Categoría -->
                <div class="mb-4">
                    <label for="categoria" class="block text-sm font-medium">Categoría</label>
                    <select name="categoria" id="categoria" class="mt-1 block w-full rounded bg-white text-black p-2">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $objeto->categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Imágenes actuales -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Imágenes actuales</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($objeto->imagenes as $imagen)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}"
                                    class="w-full h-32 object-cover rounded shadow" alt="Imagen actual">
                                <form action="{{ route('galerias.destroy', $imagen) }}" method="POST"
                                    class="absolute top-1 right-1" onsubmit="return confirm('¿Eliminar esta imagen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white text-xs px-2 py-1 rounded">X</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Subir nuevas imágenes -->
                <div class="mb-6">
                    <label for="imagenes" class="block text-sm font-medium">Añadir nuevas imágenes</label>
                    <input type="file" name="imagenes[]" id="imagenes" multiple
                        class="mt-1 block w-full text-sm bg-white text-black border border-gray-300 rounded p-2">
                </div>

                <!-- Botón de guardar -->
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 rounded text-black font-semibold"
                        style="background-color: #FFEA27;">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

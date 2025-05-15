<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            {{ __('Añadir nuevo objeto') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #AB80E5;">
        <div class="max-w-2xl mx-auto bg-[#B4007C] p-6 rounded shadow text-black">
            <form method="POST" action="{{ route('objetos.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Título -->
                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium text-white">Título</label>
                    <input type="text" name="titulo" id="titulo" required
                        class="mt-1 block w-full rounded bg-white text-black p-2">
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-white">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="mt-1 block w-full rounded bg-white text-black p-2"></textarea>
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium text-white">Estado</label>
                    <input type="text" name="estado" id="estado" required
                        class="mt-1 block w-full rounded bg-white text-black p-2">
                </div>

                <!-- Tipo de oferta -->
                <div class="mb-4">
                    <label for="tipo_oferta" class="block text-sm font-medium text-white">Tipo de oferta</label>
                    <select name="tipo_oferta" id="tipo_oferta"
                        class="mt-1 block w-full rounded bg-white text-black p-2">
                        <option value="donación">Donación</option>
                        <option value="trueque">Trueque</option>
                    </select>
                </div>

                <!-- Categoría -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Categoría existente
                    </label>
                    <select name="categoria" id="categoria"
                        class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option value="">-- Selecciona una categoría existente --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nueva_categoria" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        O crea una nueva categoría
                    </label>
                    <input type="text" name="nueva_categoria" id="nueva_categoria"
                        placeholder="Ej: Juguetes, Herramientas..."
                        class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                </div>
                <!-- Imágenes -->
                <div class="mb-4">
                    <label for="imagenes" class="block text-sm font-medium text-white">Imágenes</label>
                    <input type="file" name="imagenes[]" id="imagenes" multiple
                        class="mt-1 block w-full text-sm bg-white text-black border border-gray-300 rounded p-2">
                </div>

                <!-- Errores -->
                @if ($errors->any())
                    <div class="mb-4 p-4 rounded" style="background-color: #FF0202; color: white;">
                        <strong>Errores en el formulario:</strong>
                        <ul class="mt-2 list-disc list-inside text-white">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Botón -->
                <div class="text-right">
                    <button type="submit"
                        class="px-4 py-2 bg-[#45F85A] text-black rounded hover:bg-green-500 font-semibold">
                        Publicar objeto
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

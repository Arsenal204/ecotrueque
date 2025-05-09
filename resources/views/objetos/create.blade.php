<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir nuevo objeto') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded shadow">

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <strong>Errores en el formulario:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('objetos.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Título -->
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                <input type="text" name="titulo" id="titulo" required
                    class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3"
                    class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"></textarea>
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                <input type="text" name="estado" id="estado" required
                    class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Tipo de oferta -->
            <div class="mb-4">
                <label for="tipo_oferta" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de
                    oferta</label>
                <select name="tipo_oferta" id="tipo_oferta"
                    class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="donación">Donación</option>
                    <option value="trueque">Trueque</option>
                </select>
            </div>

            <!-- Categoría -->
            <select name="categoria" id="categoria"
                class="mt-1 block w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>


            <!-- Subida de imágenes -->
            <div class="mb-4">
                <label for="imagenes"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imágenes</label>
                <input type="file" name="imagenes[]" id="imagenes" multiple
                    class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 dark:bg-gray-700 dark:text-white border border-gray-300 rounded">
            </div>

            <!-- Botón de enviar -->
            <div class="text-right">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Publicar objeto
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

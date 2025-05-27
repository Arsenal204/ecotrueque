<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Detalles de la reclamación
        </h2>
    </x-slot>

    <div class="py-6  min-h-screen" style="background-color: #e2cc82;">
        <div class="max-w-5xl mx-auto p-6 rounded shadow text-black" style="background-color: #e2cc82;">
            <h3 class="text-lg font-semibold mb-4">Información de la
                reclamación</h3>

            <p><strong>Motivo:</strong> {{ $reclamacion->motivo }}</p>
            <p><strong>Descripción:</strong> {{ $reclamacion->descripcion ?? 'Sin descripción' }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($reclamacion->estado_reclamacion) }}</p>
            <p><strong>Fecha de reclamación:</strong> {{ $reclamacion->fecha_reclamacion }}</p>

            <hr class="my-4 border-gray-300">

            <h4 class="font-semibold">Usuarios implicados</h4>
            <p><strong>Reclamante:</strong> {{ $reclamacion->emisor->name }}</p>
            <p><strong>Reclamado:</strong> {{ $reclamacion->reclamado->name }}</p>

            <hr class="my-4 border-gray-300">

            <h4 class="font-semibold">Intercambio relacionado</h4>
            @if ($reclamacion->intercambio)
                <p><strong>Fecha:</strong> {{ $reclamacion->intercambio->fecha }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($reclamacion->intercambio->estado) }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <h5 class="font-semibold mb-2">Objeto ofrecido:</h5>
                        <img src="{{ $reclamacion->intercambio->objetoEmisor->imagenes->first() ? asset('storage/' . $reclamacion->intercambio->objetoEmisor->imagenes->first()->ruta_imagen) : asset('images/stock1.jpg') }}"
                            class="h-32 w-32 object-cover rounded mb-2" style="width: 266px; height: 266px;">
                        <p>{{ $reclamacion->intercambio->objetoEmisor->titulo }}</p>
                    </div>
                    <div>
                        <h5 class="font-semibold mb-2">Objeto recibido:</h5>
                        <img src="{{ $reclamacion->intercambio->objetoReceptor->imagenes->first() ? asset('storage/' . $reclamacion->intercambio->objetoReceptor->imagenes->first()->ruta_imagen) : asset('images/stock2.jpg') }}"
                            class="h-32 w-32 object-cover rounded mb-2" style="width: 266px; height: 266px;">
                        <p>{{ $reclamacion->intercambio->objetoReceptor->titulo }}</p>
                    </div>
                    @if ($reclamacion->ruta_imagen)
                        <div class="my-4">
                            <h4 class="font-semibold mb-2">Imagen subida por el usuario:</h4>
                            <img src="{{ asset('storage/' . $reclamacion->ruta_imagen) }}"
                                alt="Imagen de la reclamación" class="h-32 w-32 object-cover rounded mb-2"
                                style="width: 266px; height: 266px;">
                        </div>
                    @endif

                </div>
            @else
                <p>No hay intercambio asociado.</p>
            @endif

            <hr class="my-6
                                border-gray-300">

            <!-- Formulario de respuesta del admin -->
            <h3 class="text-lg font-semibold mb-4">Resolución del administrador</h3>

            <form action="{{ route('admin.reclamaciones.resolver', $reclamacion->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="resolucion_admin" class="block mb-1 font-medium">Texto de
                        resolución:</label>
                    <textarea name="resolucion_admin" id="resolucion_admin" rows="4" class="w-full rounded p-2 text-black" required>{{ old('resolucion_admin', $reclamacion->resolucion_admin) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="archivos_admin" class="block mb-1 font-medium">Adjuntar archivo
                        (opcional):</label>
                    <input type="file" name="archivos_admin" class="block w-full text-sm text-white" />
                    @if ($reclamacion->archivos_admin)
                        <p class="text-sm mt-2">
                            Archivo actual:
                            <a href="{{ asset('storage/' . $reclamacion->archivos_admin) }}"
                                class="underline text-blue-500" target="_blank">Ver archivo</a>
                        </p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="estado_reclamacion" class="block mb-1 font-medium">Cambiar
                        estado:</label>
                    <select name="estado_reclamacion" id="estado_reclamacion" class="w-full p-2 rounded text-black">
                        <option value="pendiente"
                            {{ $reclamacion->estado_reclamacion == 'pendiente' ? 'selected' : '' }}>
                            Pendiente</option>
                        <option value="en revisión"
                            {{ $reclamacion->estado_reclamacion == 'en revisión' ? 'selected' : '' }}>
                            En revisión
                        </option>
                        <option value="resuelta"
                            {{ $reclamacion->estado_reclamacion == 'resuelta' ? 'selected' : '' }}>
                            Resuelta</option>
                        <option value="rechazada"
                            {{ $reclamacion->estado_reclamacion == 'rechazada' ? 'selected' : '' }}>
                            Rechazada</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 transition">
                    Guardar resolución
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

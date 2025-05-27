<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Mis intercambios
        </h2>
    </x-slot>

    <div class="py-6 bg-[#AB80E5] min-h-screen">
        <div class="max-w-l mx-auto p-6 rounded shadow text-black dark:text-white"
            style="background-color: #ebdba7;>

            @if (session('success'))
<div class="mb-4 p-3
            bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
        @endif

        <h3 class="text-lg font-semibold mb-4">Intercambios enviados</h3>

        @php
            $enviados = $intercambios->where('id_usuario_emisor', auth()->id());
            $recibidos = $intercambios->where('id_usuario_receptor', auth()->id());
        @endphp

        @forelse ($recibidos as $inter)
            <div class="bg-green-100 dark:bg-green-900 p-4 rounded mb-6 shadow-md">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <!-- Imagen del objeto que ofrecen -->
                    <div class="w-full md:w-1/3">
                        <img src="{{ $inter->objetoEmisor->imagenes->first()
                            ? asset('storage/' . $inter->objetoEmisor->imagenes->first()->ruta_imagen)
                            : asset('images/stock1.jpg') }}"
                            alt="Imagen objeto ofrecido"
                            class="w-32 h-24 object-cover mx-auto rounded border border-gray-300">
                        <p class="mt-2 text-sm text-center font-semibold">Te ofrecen</p>
                    </div>

                    <!-- Imagen de tu objeto -->
                    <div class="w-full md:w-1/3">
                        <img src="{{ $inter->objetoReceptor->imagenes->first()
                            ? asset('storage/' . $inter->objetoReceptor->imagenes->first()->ruta_imagen)
                            : asset('images/stock2.jpg') }}"
                            alt="Imagen de tu objeto"
                            class="w-32 h-24 object-cover mx-auto rounded border border-gray-300">
                        <p class="mt-2 text-sm text-center font-semibold">Tu objeto</p>
                    </div>

                    <!-- Información y botones -->
                    <div class="w-full md:w-1/3">
                        <p><strong>De:</strong> {{ $inter->objetoEmisor->usuario->name ?? 'Usuario desconocido' }}
                        </p>
                        <p><strong>Objeto ofrecido:</strong> {{ $inter->objetoEmisor->titulo }}</p>
                        <p><strong>Tu objeto:</strong> {{ $inter->objetoReceptor->titulo }}</p>
                        <p><strong>Estado:</strong> {{ ucfirst($inter->estado) }}</p>
                        <p class="text-xs text-white-500 mt-1">Fecha: {{ $inter->fecha }}</p>

                        @if ($inter->estado === 'pendiente')
                            <div class="flex gap-2 mt-3">
                                <form action="{{ route('intercambios.confirmar', $inter->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                        Confirmar
                                    </button>
                                </form>
                                <form action="{{ route('intercambios.cancelar', $inter->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                        Rechazar
                                    </button>
                                </form>




                            </div>
                        @endif

                        @if ($inter->estado === 'confirmado')
                            <!-- Botón para abrir el modal de reclamación -->
                            <button type="button"
                                class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm"
                                data-bs-toggle="modal" data-bs-target="#reclamarModal-{{ $inter->id }}">
                                Hacer una reclamación
                            </button>

                            <!-- Modal de Reclamación -->
                            <div class="modal fade" id="reclamarModal-{{ $inter->id }}" tabindex="-1"
                                aria-labelledby="reclamarModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-white text-black">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reclamarModalLabel">Enviar reclamación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <form method="POST" action="{{ route('reclamaciones.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id_intercambio" value="{{ $inter->id }}">
                                            <input type="hidden" name="id_usuario_reclamado"
                                                value="{{ $inter->id_usuario_emisor === Auth::id() ? $inter->id_usuario_receptor : $inter->id_usuario_emisor }}">

                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="motivo" class="form-label">Motivo</label>
                                                    <input type="text" name="motivo" id="motivo"
                                                        class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required></textarea>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="imagen"
                                                        class="block text-sm font-medium text-gray-700 dark:text-white">
                                                        Subir imagen del producto (opcional)
                                                    </label>
                                                    <input type="file" name="imagen" id="imagen" accept="image/*"
                                                        class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer dark:text-white dark:bg-gray-700 dark:border-gray-600">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Enviar
                                                    Reclamación</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-400">No has recibido solicitudes de intercambio.</p>
        @endforelse

    </div>
    <h3 class="text-lg font-semibold mt-8 mb-4">Intercambios realizados</h3>

    @php
        $realizados = $intercambios->filter(function ($i) {
            return $i->estado === 'confirmado';
        });
    @endphp

    @forelse ($realizados as $inter)
        <div class="bg-purple-100 dark:bg-purple-900 p-4 rounded mb-4 shadow">
            <p><strong>Tú:</strong>
                {{ $inter->objetoEmisor->usuario === Auth::id() ? 'Intercambiaste' : 'Recibiste' }}</p>
            <p><strong>Objeto tuyo:</strong>
                {{ $inter->objetoEmisor->usuario === Auth::id() ? $inter->objetoEmisor->titulo : $inter->objetoReceptor->titulo }}
            </p>
            <p><strong>Objeto del otro usuario:</strong>
                {{ $inter->objetoEmisor->usuario === Auth::id() ? $inter->objetoReceptor->titulo : $inter->objetoEmisor->titulo }}
            </p>
            <p class="text-xs text-gray-500 mt-1">Fecha: {{ $inter->fecha }}</p>
        </div>
    @empty
        <p class="text-gray-600 dark:text-gray-400">Aún no has completado intercambios.</p>
    @endforelse

    </div>
</x-app-layout>

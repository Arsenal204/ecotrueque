<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.4rem; font-weight:700; color:#fff;">
            Conversación con {{ $usuario->name }}
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:700px; margin:0 auto; background:#fff; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10);">
            <!-- Zona de mensajes -->
            <div
                style="padding:2rem; height:500px; overflow-y:auto; background-color:#e2cc82; border-radius:1rem 1rem 0 0;">
                @forelse ($mensajes as $mensaje)
                    <div
                        style="display:flex; justify-content:{{ $mensaje->id_emisor === auth()->id() ? 'flex-end' : 'flex-start' }}; margin-bottom:1.2rem;">
                        <div
                            style="
                            max-width:70%;
                            padding:0.8rem 1.2rem;
                            border-radius:1rem;
                            background-color:{{ $mensaje->id_emisor === auth()->id() ? '#ffe066' : '#b4007c' }};
                            color:{{ $mensaje->id_emisor === auth()->id() ? '#222' : '#fff' }};
                            box-shadow:0 2px 8px rgba(34,139,34,0.10);
                            ">
                            <p style="margin:0 0 0.3rem 0; font-size:1rem;">{{ $mensaje->contenido }}</p>
                            <span
                                style="display:block; font-size:0.85rem; color:{{ $mensaje->id_emisor === auth()->id() ? '#888' : '#ffe066' }};">
                                {{ $mensaje->created_at->format('H:i d/m/Y') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center; color:#b4007c;">No hay mensajes aún.</p>
                @endforelse
            </div>

            <!-- Formulario de envío -->
            <form method="POST" action="{{ route('mensajes.store') }}"
                style="display:flex; align-items:center; border-top:1px solid #e2cc82; background-color:#f9fafb; border-radius:0 0 1rem 1rem; padding:1rem 2rem;">
                @csrf
                <input type="hidden" name="id_receptor" value="{{ $usuario->id }}">

                <input type="text" name="contenido" required placeholder="Escribe un mensaje..."
                    style="flex:1; padding:0.7rem 1rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem; margin-right:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                    onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                    onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />

                <button type="submit"
                    style="background:#ffe066; color:#222; font-weight:700; padding:0.7rem 1.5rem; border-radius:0.5rem; border:none; font-size:1rem; transition:background 0.2s; cursor:pointer;"
                    onmouseover="this.style.background='#ffe9a7';" onmouseout="this.style.background='#ffe066';">
                    Enviar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

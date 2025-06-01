<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.3rem; font-weight:700; color:#fff;">
            Cuenta Baneada
        </h2>
    </x-slot>

    <div
        style="min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; background-color:#ebdba7;">
        <div
            style="color:#222; padding:2.5rem 2rem; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); max-width:480px; width:100%; background:#e2cc82; text-align:center;">
            <h1 style="font-size:2rem; font-weight:800; margin-bottom:1.2rem; color:#000000;">
                Tu cuenta ha sido suspendida
            </h1>
            <p style="margin-bottom:2rem; color:#444;">
                Un administrador ha marcado tu cuenta como baneada.<br>
                No podrás acceder a las funciones de EcoTrueque.
            </p>

            <div style="display:flex; flex-direction:column; gap:1rem; margin-bottom:2.5rem;">
                <!-- Eliminar cuenta -->
                <form action="{{ route('profile.destroy') }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta definitivamente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="width:100%; background:#e10909; color:#fff; font-weight:700; padding:0.7rem 0; border-radius:0.5rem; border:none; font-size:1rem; transition:background 0.2s;"
                        onmouseover="this.style.background='#b4007c';" onmouseout="this.style.background='#e10909';">
                        Eliminar cuenta
                    </button>
                </form>

                <!-- Cerrar sesión -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="width:100%; background:#FFEA27; color:#222; font-weight:700; padding:0.7rem 0; border-radius:0.5rem; border:none; font-size:1rem; transition:background 0.2s;"
                        onmouseover="this.style.background='#ffe066';" onmouseout="this.style.background='#FFEA27';">
                        Cerrar sesión
                    </button>
                </form>
            </div>

            <div
                style="margin-top:2rem; background:#fff; padding:2rem 1.5rem; border-radius:0.8rem; box-shadow:0 2px 8px rgba(34,139,34,0.08); text-align:left;">
                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:1rem; color:#5C3F94;">
                    Contactar con un administrador
                </h3>

                @if (session('success'))
                    <div
                        style="margin-bottom:1rem; padding:0.7rem 1rem; background:#45F85A; color:#222; border-radius:0.5rem; font-weight:600;">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('mensajes.baneado') }}" method="POST">
                    @csrf
                    <label for="contenido"
                        style="display:block; margin-bottom:0.5rem; color:#222; font-weight:600;">Mensaje:</label>
                    <textarea name="contenido" rows="4" required
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; resize:vertical; margin-bottom:1rem;"></textarea>

                    <button type="submit"
                        style="background:#45F85A; color:#222; font-weight:700; padding:0.6rem 1.5rem; border-radius:0.5rem; border:none; font-size:1rem; transition:background 0.2s; display:inline-flex; align-items:center; gap:0.5rem;"
                        onmouseout="this.style.background='#45F85A'; this.style.color='#222';"
                        onmouseover="this.style.background='#33b342'; this.style.color='#fff';">
                        <!-- Mensaje SVG -->
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="#222"
                                stroke-width="2" fill="none" />
                            <path d="M3 6l9 6 9-6" stroke="#222" stroke-width="2" fill="none" />
                        </svg>
                        Enviar a los administradores
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

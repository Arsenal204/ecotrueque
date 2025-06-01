<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.3rem; font-weight:700; color:#fff; letter-spacing:0.02em;">
            Conversaciones
        </h2>
    </x-slot>

    <div style="background: linear-gradient(100deg, #e2cc82 60%, #b6e388 100%); min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:520px; margin:0 auto; background:#a4dc56; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#fff;">
            <h3 style="font-size:1.2rem; font-weight:600; margin-bottom:1.5rem; letter-spacing:0.01em;">
                Usuarios con los que has hablado
            </h3>

            @if ($usuariosConConversacion->isEmpty())
                <p style="text-align:center; color:#ffe066;">Aún no tienes conversaciones.</p>
            @else
                <ul style="list-style:none; padding:0; margin:0;">
                    @foreach ($usuariosConConversacion as $user)
                        <li style="margin-bottom:1.2rem;">
                            <a href="{{ route('mensajes.conversacion', $user) }}"
                                style="display:flex; align-items:center; gap:1rem; background:#FFEA27; color:#222; border-radius:0.7rem; padding:0.85rem 1.2rem; font-weight:600; text-decoration:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s, color 0.2s;"
                                onmouseover="this.style.background='#ffe066'; this.style.color='#B4007C';"
                                onmouseout="this.style.background='#FFEA27'; this.style.color='#222';">
                                <!-- Avatar con inicial -->
                                <span
                                    style="display:inline-flex; align-items:center; justify-content:center; width:2.3rem; height:2.3rem; border-radius:9999px; background:#b6e388; color:#5C3F94; font-size:1.2rem; font-weight:700; box-shadow:0 1px 4px rgba(34,139,34,0.10);">
                                    {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                                </span>
                                <span>{{ $user->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>

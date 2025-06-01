<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.5rem; font-weight:700; color:#fff; letter-spacing:0.02em;">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div style="background-color: #e2cc82; min-height:100vh; padding:3rem 0;">
        <div style="max-width:1100px; margin:0 auto;">
            <div
                style="background:#57cc59; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#fff;">
                <h3 style="font-size:1.25rem; font-weight:600; margin-bottom:2rem; letter-spacing:0.01em;">
                    Lista de usuarios
                </h3>

                <div style="overflow-x:auto;">
                    <table
                        style="width:100%; border-collapse:separate; border-spacing:0; background:#fff; color:#222; border-radius:0.8rem; overflow:hidden; box-shadow:0 2px 8px rgba(34,139,34,0.08);">
                        <thead>
                            <tr style="background:#e2cc82;">
                                <th style="padding:0.8rem 1rem; font-size:1rem; font-weight:700; text-align:left;">ID
                                </th>
                                <th style="padding:0.8rem 1rem; font-size:1rem; font-weight:700; text-align:left;">
                                    Nombre</th>
                                <th style="padding:0.8rem 1rem; font-size:1rem; font-weight:700; text-align:left;">Email
                                </th>
                                <th style="padding:0.8rem 1rem; font-size:1rem; font-weight:700; text-align:left;">Rol
                                </th>
                                <th style="padding:0.8rem 1rem; font-size:1rem; font-weight:700; text-align:left;">
                                    Registro</th>
                                <th style="padding:0.8rem 1rem; font-size:1rem; font-weight:700; text-align:left;">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $user)
                                <tr style="transition:background 0.2s;" onmouseover="this.style.background='#f9fafb';"
                                    onmouseout="this.style.background='#fff';">
                                    <td style="padding:0.7rem 1rem;">{{ $user->id }}</td>
                                    <td style="padding:0.7rem 1rem;">{{ $user->name ?? $user->nombre }}</td>
                                    <td style="padding:0.7rem 1rem;">{{ $user->email }}</td>
                                    <td style="padding:0.7rem 1rem;">{{ ucfirst($user->tipo_usuario) }}</td>
                                    <td style="padding:0.7rem 1rem;">{{ $user->created_at->format('d/m/Y') }}</td>
                                    <td style="padding:0.7rem 1rem;">
                                        <div style="display:flex; gap:0.5rem;">
                                            <!-- Editar -->
                                            <a href="{{ route('admin.usuarios.edit', $user->id) }}"
                                                style="display:inline-flex; align-items:center; gap:0.3rem; background:#ffe066; color:#222; font-weight:600; padding:0.4rem 0.8rem; border-radius:0.4rem; text-decoration:none; transition:background 0.2s;"
                                                onmouseover="this.style.background='#FFEA27';"
                                                onmouseout="this.style.background='#ffe066';">
                                                <!-- Lápiz SVG -->
                                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                                                    <path
                                                        d="M4 20h4l10.29-10.29a1 1 0 0 0 0-1.41l-2.59-2.59a1 1 0 0 0-1.41 0L4 16v4z"
                                                        stroke="#222" stroke-width="2" fill="none" />
                                                    <path d="M14.5 7.5l2 2" stroke="#222" stroke-width="2"
                                                        fill="none" />
                                                </svg>
                                                Editar
                                            </a>
                                            <!-- Eliminar -->
                                            <form action="{{ route('admin.usuarios.destroy', $user->id) }}"
                                                method="POST" style="display:inline;"
                                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    style="display:inline-flex; align-items:center; gap:0.3rem; background:#e10909; color:#fff; font-weight:600; padding:0.4rem 0.8rem; border-radius:0.4rem; border:none; transition:background 0.2s;"
                                                    onmouseover="this.style.background='#b4007c';"
                                                    onmouseout="this.style.background='#e10909';">
                                                    <!-- Papelera SVG -->
                                                    <svg width="16" height="16" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <rect x="5" y="7" width="14" height="12" rx="2"
                                                            stroke="#fff" stroke-width="2" fill="none" />
                                                        <path d="M3 7h18" stroke="#fff" stroke-width="2" />
                                                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#fff"
                                                            stroke-width="2" />
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                            <!-- Mensaje -->
                                            <a href="{{ route('mensajes.create', $user->id) }}"
                                                style="display:inline-flex; align-items:center; gap:0.3rem; background:#45F85A; color:#222; font-weight:600; padding:0.4rem 0.8rem; border-radius:0.4rem; text-decoration:none; transition:background 0.2s;"
                                                onmouseover="this.style.background='#76a03b'; this.style.color='#fff';"
                                                onmouseout="this.style.background='#45F85A'; this.style.color='#222';">
                                                <!-- Mensaje SVG -->
                                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                                                    <path
                                                        d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"
                                                        stroke="#222" stroke-width="2" fill="none" />
                                                    <path d="M3 6l9 6 9-6" stroke="#222" stroke-width="2"
                                                        fill="none" />
                                                </svg>
                                                Mensaje
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($usuarios->isEmpty())
                    <p style="color:#fff; margin-top:2rem; text-align:center;">No hay usuarios registrados.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

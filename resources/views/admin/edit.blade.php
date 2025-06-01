<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.3rem; font-weight:700; color:#fff;">
            Editar Usuario
        </h2>
    </x-slot>

    <div style="background-color: #e2cc82; min-height:100vh; padding:3rem 0;">
        <div
            style="max-width:420px; margin:0 auto; background:#55c34d; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#fff;">
            <form action="{{ route('admin.usuarios.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Rol -->
                <div style="margin-bottom:1.5rem;">
                    <label for="tipo_usuario" style="display:block; font-weight:600; margin-bottom:0.5rem;">Rol</label>
                    <select name="tipo_usuario" id="tipo_usuario"
                        style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                        <option value="admin" {{ $user->tipo_usuario === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="donante" {{ $user->tipo_usuario === 'donante' ? 'selected' : '' }}>Donante
                        </option>
                        <option value="receptor" {{ $user->tipo_usuario === 'receptor' ? 'selected' : '' }}>Receptor
                        </option>
                    </select>
                </div>

                <!-- Baneo -->
                <div style="margin-bottom:2rem;">
                    <label style="display:flex; align-items:center; gap:0.7rem; font-weight:600;">
                        <input type="checkbox" name="baneado" value="1" {{ $user->baneado ? 'checked' : '' }}
                            style="width:1.1rem; height:1.1rem; accent-color:#e10909;">
                        <span>¿Usuario baneado?</span>
                    </label>
                </div>

                <button type="submit"
                    style="background:#FFEA27; color:#222; font-weight:700; font-size:1rem; padding:0.7rem 2rem; border-radius:0.5rem; border:none; box-shadow:0 2px 8px rgba(34,139,34,0.10); transition:background 0.2s; cursor:pointer;"
                    onmouseover="this.style.background='#ffe066';" onmouseout="this.style.background='#FFEA27';">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

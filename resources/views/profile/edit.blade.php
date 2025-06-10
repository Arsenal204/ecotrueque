<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:1.5rem; font-weight:700; color:#5C3F94;">
            {{ __('Editar perfil') }}
        </h2>
    </x-slot>

    <div style="background-color: #ebdba7; min-height:100vh; padding:2rem 0;">
        <div style="max-width:600px; margin:0 auto;">
            <div
                style="background:#8dbf48; border-radius:1rem; box-shadow:0 2px 8px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#222;">

                @if (session('status') === 'profile-updated')
                    <div style="margin-bottom:1.5rem; color:#45F85A; font-weight:600;">
                        Perfil actualizado correctamente.
                    </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <!-- Nombre -->
                    <div style="margin-bottom:1.2rem;">
                        <label for="name"
                            style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Nombre</label>
                        <input id="name" name="name" type="text"
                            value="{{ old('name', Auth::user()->name ?? '') }}" required autofocus
                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                    </div>

                    <!-- Email -->
                    <div style="margin-bottom:1.2rem;">
                        <label for="email"
                            style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Correo
                            electrónico</label>
                        <input id="email" name="email" type="email"
                            value="{{ old('email', Auth::user()->email) }}" required
                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                    </div>

                    <!-- Teléfono -->
                    <div style="margin-bottom:1.2rem;">
                        <label for="telefono"
                            style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Teléfono</label>
                        <input id="telefono" name="telefono" type="text"
                            value="{{ old('telefono', Auth::user()->telefono) }}"
                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                    </div>

                    <!-- Dirección -->
                    <div style="margin-bottom:1.2rem;">
                        <label for="direccion"
                            style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Dirección</label>
                        <input id="direccion" name="direccion" type="text"
                            value="{{ old('direccion', Auth::user()->direccion) }}"
                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                    </div>

                    <!-- Ciudad -->
                    <div style="margin-bottom:1.2rem;">
                        <label for="ciudad"
                            style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Ciudad</label>
                        <input id="ciudad" name="ciudad" type="text"
                            value="{{ old('ciudad', Auth::user()->ciudad) }}"
                            style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#fff; color:#222; font-size:1rem;">
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:1rem; margin-top:2rem;">
                        <button type="submit"
                            style="background:#45F85A; color:#222; font-weight:700; padding:0.7rem 2rem; border-radius:0.5rem; border:none; font-size:1rem; cursor:pointer; transition:background 0.2s;"
                            onmouseover="this.style.background='#76a03b';"
                            onmouseout="this.style.background='#45F85A';">
                            Guardar
                        </button>
                    </div>
                </form>

                <hr style="margin:2rem 0; border:0; border-top:1px solid #fff;">

                <!-- Eliminar cuenta -->
                <form method="post" action="{{ route('profile.destroy') }}"
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta?');">
                    @csrf
                    @method('delete')

                    <button type="submit"
                        style="background:#b4007c; color:#fff; font-weight:700; padding:0.7rem 2rem; border-radius:0.5rem; border:none; font-size:1rem; cursor:pointer; transition:background 0.2s;"
                        onmouseover="this.style.background='#8d005c';" onmouseout="this.style.background='#b4007c';">
                        Eliminar cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

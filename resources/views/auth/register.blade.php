<x-guest-layout>
    <div
        style="min-height:100vh; display:flex; flex-direction:column; justify-content:center; align-items:center; padding:1.5rem; background: linear-gradient(100deg, #e2cc82 60%, #b6e388 100%);">
        <div
            style="width:100%; max-width:400px; padding:2rem; border-radius:1rem; box-shadow:0 8px 32px 0 rgba(34,139,34,0.15); border:1px solid #b6e388; background:rgba(255,255,255,0.93); color:#222;">
            <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:1.5rem;">
                <img src="{{ asset('images/logo.png') }}" alt="EcoTrueque"
                    style="width:4rem; height:4rem; margin-bottom:0.5rem; border-radius:9999px; box-shadow:0 2px 8px 0 rgba(34,139,34,0.15);" />
                <h2 style="font-size:2rem; font-weight:800; text-align:center; margin-bottom:0.5rem; color:#76a03b;">
                    Crear cuenta</h2>
                <span style="font-size:1rem; color:#666;">en EcoTrueque</span>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div style="margin-bottom:1rem;">
                    <label for="name"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Nombre
                        completo</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('name')" style="margin-top:0.5rem;" />
                </div>

                <!-- Email -->
                <div style="margin-bottom:1rem;">
                    <label for="email"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Correo
                        electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('email')" style="margin-top:0.5rem;" />
                </div>

                <!-- Teléfono -->
                <div style="margin-bottom:1rem;">
                    <label for="telefono"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Teléfono</label>
                    <input id="telefono" type="text" name="telefono" :value="old('telefono')"
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('telefono')" style="margin-top:0.5rem;" />
                </div>

                <!-- Dirección -->
                <div style="margin-bottom:1rem;">
                    <label for="direccion"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Dirección</label>
                    <input id="direccion" type="text" name="direccion" :value="old('direccion')"
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('direccion')" style="margin-top:0.5rem;" />
                </div>

                <!-- Ciudad -->
                <div style="margin-bottom:1rem;">
                    <label for="ciudad"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Ciudad</label>
                    <input id="ciudad" type="text" name="ciudad" :value="old('ciudad')" required
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('ciudad')" style="margin-top:0.5rem;" />
                </div>

                <!-- Contraseña -->
                <div style="margin-bottom:1rem;">
                    <label for="password"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('password')" style="margin-top:0.5rem;" />
                </div>

                <!-- Confirmar contraseña -->
                <div style="margin-bottom:1rem;">
                    <label for="password_confirmation"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Confirmar
                        contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('password_confirmation')" style="margin-top:0.5rem;" />
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; margin-top:2rem;">
                    <a href="{{ route('login') }}"
                        style="font-size:0.95rem; color:#76a03b; text-decoration:underline; font-weight:600; transition:color 0.2s;"
                        onmouseover="this.style.color='#b6e388';" onmouseout="this.style.color='#76a03b';">
                        ¿Ya tienes cuenta?
                    </a>
                    <button type="submit"
                        style="background:#76a03b; color:#fff; font-weight:700; padding:0.5rem 1.5rem; border-radius:0.5rem; box-shadow:0 2px 8px 0 rgba(34,139,34,0.10); border:none; transition:background 0.2s;"
                        onmouseover="this.style.background='#b6e388';" onmouseout="this.style.background='#76a03b';">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

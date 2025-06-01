<x-guest-layout>
    <div
        style="min-height:100vh; display:flex; flex-direction:column; justify-content:center; align-items:center; padding:1.5rem; background: linear-gradient(100deg, #e2cc82 60%, #b6e388 100%);">
        <div
            style="width:100%; max-width:400px; padding:2rem; border-radius:1rem; box-shadow:0 8px 32px 0 rgba(34,139,34,0.15); border:1px solid #b6e388; background:rgba(255,255,255,0.9); color:#222;">
            <div style="display:flex; flex-direction:column; align-items:center; margin-bottom:1.5rem;">
                <img src="{{ asset('images/logo.png') }}" alt="EcoTrueque"
                    style="width:4rem; height:4rem; margin-bottom:0.5rem; border-radius:9999px; box-shadow:0 2px 8px 0 rgba(34,139,34,0.15);" />
                <h2 style="font-size:2rem; font-weight:800; text-align:center; margin-bottom:0.5rem; color:#76a03b;">
                    Iniciar sesión</h2>
                <span style="font-size:1rem; color:#666;">en EcoTrueque</span>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div style="margin-bottom:1rem;">
                    <label for="email"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Correo
                        electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div style="margin-bottom:1rem;">
                    <label for="password"
                        style="display:block; font-size:0.95rem; font-weight:600; color:#444; margin-bottom:0.25rem;">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        style="width:100%; margin-top:0.25rem; padding:0.5rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; transition:box-shadow 0.2s, border-color 0.2s;"
                        onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                        onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
                    <label for="remember_me"
                        style="display:inline-flex; align-items:center; font-size:0.95rem; color:#444;">
                        <input id="remember_me" type="checkbox" name="remember"
                            style="border-radius:0.25rem; border:1px solid #ccc; accent-color:#76a03b; box-shadow:0 1px 2px 0 rgba(34,139,34,0.05); margin-right:0.5rem;">
                        <span>Recuérdame</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            style="font-size:0.95rem; color:#76a03b; text-decoration:underline; font-weight:600; transition:color 0.2s;"
                            onmouseover="this.style.color='#b6e388';"
                            onmouseout="this.style.color='#76a03b';">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <!-- Botón de login -->
                <div>
                    <button type="submit"
                        style="width:100%; background:#76a03b; color:#fff; font-weight:700; padding:0.5rem 1rem; border-radius:0.5rem; box-shadow:0 2px 8px 0 rgba(34,139,34,0.10); border:none; transition:background 0.2s;"
                        onmouseover="this.style.background='#b6e388';" onmouseout="this.style.background='#76a03b';">
                        Iniciar sesión
                    </button>
                </div>
            </form>

            <p style="margin-top:1.5rem; font-size:0.95rem; text-align:center; color:#444;">
                ¿No tienes una cuenta?
                <a href="{{ route('register') }}"
                    style="color:#76a03b; text-decoration:underline; font-weight:600; transition:color 0.2s;"
                    onmouseover="this.style.color='#b6e388';" onmouseout="this.style.color='#76a03b';">Regístrate
                    aquí</a>
            </p>
        </div>
    </div>
</x-guest-layout>

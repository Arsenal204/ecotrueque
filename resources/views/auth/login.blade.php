<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center p-6" style="background-color: #b2a26b;">
        <div class="w-50 max-w-md p-8 rounded-lg shadow-lg text-black dark:text-white" style="background-color: #e2cc82">

            <h2 class="text-2xl font-bold text-center mb-6" style="background-color:#76a03b ">Iniciar
                sesión en EcoTrueque</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 ">Correo
                        electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-700">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-indigo-500">
                        <span class="ml-2">Recuérdame</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-yellow-300 text-gray-700 hover:text-yellow-400 underline">¿Olvidaste tu
                            contraseña?</a>
                    @endif
                </div>

                <!-- Botón de login -->
                <div>
                    <button type="submit"
                        class="w-20 hover:bg-yellow-400 text-gray-700  font-bold py-2 px-4 rounded transition"
                        style="background-color: #FFEA27,">
                        Iniciar sesión
                    </button>
                </div>
            </form>

            <p class="mt-4 text-sm text-center text-black text-gray-700">
                ¿No tienes una cuenta?
                <a href="{{ route('register') }}" class="text-yellow-300 hover:text-yellow-400 font-semibold underline">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>

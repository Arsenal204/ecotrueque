<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center p-6" style="background-color: #b2a26b">
        <div class="w-full max-w-md p-8 rounded-lg shadow-lg text-black dark:text-white"
            style="background-color: #e2cc82">

            <h2 class="text-2xl font-bold text-center text-black mb-6" style="background-color: #76a03b ">Crear cuenta en
                EcoTrueque</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-white">Nombre
                        completo</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black " />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-white">Correo
                        electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black " />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Teléfono  -->
                <div class="mb-4">
                    <label for="telefono" class="block text-sm font-medium text-white">Teléfono
                    </label>
                    <input id="telefono" type="text" name="telefono" :value="old('telefono')"
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black dark:text-white" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>

                <!-- Dirección  -->
                <div class="mb-4">
                    <label for="direccion" class="block text-sm font-medium text-white">Dirección
                    </label>
                    <input id="direccion" type="text" name="direccion" :value="old('direccion')"
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black dark:text-white" />
                    <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                </div>

                <!-- Ciudad -->
                <div class="mb-4">
                    <label for="ciudad" class="block text-sm font-medium text-white">Ciudad</label>
                    <input id="ciudad" type="text" name="ciudad" :value="old('ciudad')" required
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black dark:text-white" />
                    <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
                </div>


                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-white">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black dark:text-white" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-white">Confirmar
                        contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-black dark:text-white" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-yellow-300 hover:text-yellow-400 underline">
                        ¿Ya tienes cuenta?
                    </a>

                    <button type="submit" class="hover:bg-yellow-400 text-black font-bold py-2 px-4 rounded transition"
                        style="background-color: #FFEA27">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

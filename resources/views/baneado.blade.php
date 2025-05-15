<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">Cuenta Baneada</h2>
    </x-slot>

    <div class="min-h-screen flex flex-col items-center justify-center" style="background-color: #AB80E5;">
        <div class="text-white p-10 rounded-lg shadow-lg max-w-xl text-center" style="background-color: #7959a3;">
            <h1 class="text-4xl font-extrabold mb-4">Tu cuenta ha sido suspendida</h1>
            <p class="mb-6">
                Un administrador ha marcado tu cuenta como baneada. No podrás acceder a las funciones de EcoTrueque.
            </p>

            <div class="space-y-4">
                <!-- Eliminar cuenta -->
                <form action="{{ route('profile.destroy') }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta definitivamente?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        Eliminar cuenta
                    </button>
                </form>

                <!-- Cerrar sesión -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-6 py-2 bg-[#FFEA27] text-black font-semibold rounded hover:bg-yellow-400 transition">
                        Cerrar sesión
                    </button>
                </form>
            </div>
            <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded shadow max-w-xl mx-auto">
                <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Contactar con un administrador</h3>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('mensajes.baneado') }}" method="POST">
                    @csrf
                    <label for="contenido" class="block mb-2 text-sm text-gray-800 dark:text-gray-200">Mensaje:</label>
                    <textarea name="contenido" rows="4" required
                        class="w-full p-2 rounded text-black dark:text-white dark:bg-gray-700"></textarea>

                    <button type="submit"
                        class="mt-4 bg-[#FFEA27] text-black px-4 py-2 rounded hover:bg-yellow-400 transition">
                        Enviar a los administradores
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

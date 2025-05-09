<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Editar perfil') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #AB80E5;">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 text-black" style="background-color: #B4007C;">

                @if (session('status') === 'profile-updated')
                    <div class="mb-4 text-green-300">
                        Perfil actualizado correctamente.
                    </div>
                @endif

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Nombre -->
                    <div>
                        <label for="name" class="block text-sm font-medium">Nombre</label>
                        <input id="name" name="name" type="text"
                            value="{{ old('name', Auth::user()->name ?? '') }}" required autofocus
                            class="mt-1 block w-full rounded bg-white p-2"style="text-color: black;">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium">Correo electrónico</label>
                        <input id="email" name="email" type="email"
                            value="{{ old('email', Auth::user()->email) }}" required
                            class="mt-1 block w-full rounded bg-white p-2"style="text-color: black;">
                    </div>

                    <div class="flex items-center justify-end gap-4">
                        <x-primary-button class="px-4 py-2 rounded" style="background-color: #45F85A; color: black;">
                            Guardar
                        </x-primary-button>
                    </div>
                </form>

                <hr class="my-6 border-white">

                <!-- Eliminar cuenta -->
                <form method="post" action="{{ route('profile.destroy') }}"
                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta?');">
                    @csrf
                    @method('delete')

                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                        Eliminar cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

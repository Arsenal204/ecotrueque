<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #e2cc82;">
        <div class="max-w-xl mx-auto bg-[#B4007C] p-6 rounded text-black">
            <form action="{{ route('admin.usuarios.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Rol -->
                <div class="mb-4">
                    <label for="tipo_usuario" class="block mb-1">Rol</label>
                    <select name="tipo_usuario" id="tipo_usuario" class="w-full p-2 rounded text-black">
                        <option value="admin" {{ $user->tipo_usuario === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="donante" {{ $user->tipo_usuario === 'donante' ? 'selected' : '' }}>Donante
                        </option>
                        <option value="receptor" {{ $user->tipo_usuario === 'receptor' ? 'selected' : '' }}>Receptor
                        </option>
                    </select>
                </div>

                <!-- Baneo -->
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="baneado" value="1" {{ $user->baneado ? 'checked' : '' }}>
                        <span class="ml-2">¿Usuario baneado?</span>
                    </label>
                </div>

                <button type="submit" class="bg-[#FFEA27] text-black px-4 py-2 rounded hover:bg-yellow-400">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

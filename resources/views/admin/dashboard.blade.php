<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-6" style="background-color: #e2cc82;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#B4007C] p-6 rounded shadow text-black">
                <h3 class="text-lg font-semibold mb-4">Lista de usuarios</h3>

                <table class="w-full text-left text-black bg-white rounded overflow-hidden">
                    <thead class="bg-gray-200 text-sm text-gray-700">
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Rol</th>
                            <th class="px-4 py-2">Registro</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y">
                        @foreach ($usuarios as $user)
                            <tr>
                                <td class="px-4 py-2">{{ $user->id }}</td>
                                <td class="px-4 py-2">{{ $user->name ?? $user->nombre }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">{{ ucfirst($user->tipo_usuario) }}</td>
                                <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('admin.usuarios.edit', $user->id) }}"
                                        class="inline-block px-2 py-1 bg-yellow-400 text-black text-sm font-medium rounded hover:bg-yellow-500 transition">
                                        Editar
                                    </a>
                                    <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                    <a href="{{ route('mensajes.create', $user->id) }}"
                                        class="text-sm bg-[#FFEA27] text-black px-2 py-1 rounded hover:bg-yellow-400">
                                        Enviar mensaje
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($usuarios->isEmpty())
                    <p class="text-white mt-4">No hay usuarios registrados.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

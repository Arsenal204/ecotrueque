<nav class="border-b border-gray-100  dark:border-none" style="background-color: #8dbf48;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-white font-bold text-xl">
                        EcoTrueque
                    </a>
                </div>

                <!-- Links -->

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <div></div>
                    @php
                        $rol = Auth::user()?->tipo_usuario;
                    @endphp

                    <!-- Enlace común para todos -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                        Inicio
                    </x-nav-link>

                    <x-nav-link href="{{ route('mensajes.index') }}" :active="request()->routeIs('mensajes.index')" class="text-white">
                        {{ __('Mensajes') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('objetos.explorar') }}" :active="request()->routeIs('objetos.explorar')" class="text-white">
                        {{ __('Explorar objetos') }}
                    </x-nav-link>

                    <x-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')" class="text-white">
                        {{ __('Usuarios') }}
                    </x-nav-link>

                    <!-- Solo para admin -->
                    @if ($rol === 'admin')
                        <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')" class="text-white">
                            Panel Admin
                        </x-nav-link>

                        <x-nav-link :href="route('admin.reclamaciones.index')" :active="request()->routeIs('reclamaciones.*')" class="text-white">
                            Reclamaciones
                        </x-nav-link>
                    @endif

                    <!-- Solo para donante o receptor -->
                    @if (in_array($rol, ['donante', 'receptor']))
                        <x-nav-link :href="route('objetos.index')" :active="request()->routeIs('objetos.*')" class="text-white">
                            Mis objetos
                        </x-nav-link>

                        <x-nav-link :href="route('reclamaciones.mias')" :active="request()->routeIs('reclamaciones.mias')" class="text-white">
                            {{ __('Mis reclamaciones') }}
                        </x-nav-link>
                    @endif

                    @if (in_array($rol, ['donante', 'receptor']))
                        <x-nav-link :href="route('intercambios.index')" :active="request()->routeIs('intercambios.*')" class="text-white">
                            Intercambios
                            @php
                                $pendientes = \App\Models\Intercambio::where('id_usuario_receptor', Auth::id())
                                    ->where('estado', 'pendiente')
                                    ->count();
                            @endphp
                            @if ($pendientes > 0)
                                <span class="ml-1 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                                    {{ $pendientes }}
                                </span>
                            @endif
                        </x-nav-link>
                    @endif


                </div>
            </div>

            <!-- Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-white hover:text-yellow-300 focus:outline-none">
                            <div>{{ Auth::user()->name ?? Auth::user()->email }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

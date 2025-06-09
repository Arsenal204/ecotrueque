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

                    <!-- Inicio -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white" title="Inicio">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                            style="vertical-align:middle;">
                            <path d="M3 12L12 4l9 8" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M5 10v10h14V10" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </x-nav-link>

                    <!-- Mensajes -->
                    <x-nav-link href="{{ route('mensajes.index') }}" :active="request()->routeIs('mensajes.index')" class="text-white"
                        title="Mensajes">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                            style="vertical-align:middle;">
                            <path d="M4 4h16v14H5.17L4 20V4z" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </x-nav-link>

                    <!-- Explorar objetos -->
                    <x-nav-link href="{{ route('objetos.explorar') }}" :active="request()->routeIs('objetos.explorar')" class="text-white"
                        title="Explorar objetos">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                            style="vertical-align:middle;">
                            <circle cx="11" cy="11" r="7" stroke="#fff" stroke-width="2" />
                            <path d="M21 21l-4.35-4.35" stroke="#fff" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </x-nav-link>

                    <!-- Usuarios -->
                    <x-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.index')" class="text-white" title="Usuarios">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                            style="vertical-align:middle;">
                            <circle cx="12" cy="8" r="4" stroke="#fff" stroke-width="2" />
                            <path d="M4 20c0-2.21 3.58-4 8-4s8 1.79 8 4" stroke="#fff" stroke-width="2" />
                        </svg>
                    </x-nav-link>

                    <!-- Solo para admin -->
                    @if ($rol === 'admin')
                        <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')" class="text-white" title="Panel Admin">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                                style="vertical-align:middle;">
                                <rect x="3" y="3" width="18" height="18" rx="3" stroke="#fff"
                                    stroke-width="2" />
                                <path d="M7 7h10v10H7z" stroke="#fff" stroke-width="2" />
                            </svg>
                        </x-nav-link>

                        <x-nav-link :href="route('admin.reclamaciones.index')" :active="request()->routeIs('reclamaciones.*')" class="text-white" title="Reclamaciones">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                                style="vertical-align:middle;">
                                <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="2" />
                                <rect x="11" y="7" width="2" height="7" rx="1" fill="#fff" />
                                <rect x="11" y="16" width="2" height="2" rx="1" fill="#fff" />
                            </svg>
                        </x-nav-link>
                    @endif

                    <!-- Solo para donante o receptor -->
                    @if (in_array($rol, ['donante', 'receptor']))
                        <x-nav-link :href="route('objetos.index')" :active="request()->routeIs('objetos.*')" class="text-white" title="Mis objetos">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                                style="vertical-align:middle;">
                                <rect x="4" y="7" width="16" height="10" rx="2" stroke="#fff"
                                    stroke-width="2" />
                                <path d="M8 7V5a4 4 0 0 1 8 0v2" stroke="#fff" stroke-width="2" />
                            </svg>
                        </x-nav-link>

                        <x-nav-link :href="route('reclamaciones.mias')" :active="request()->routeIs('reclamaciones.mias')" class="text-white"
                            title="Mis reclamaciones">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24"
                                style="vertical-align:middle;">
                                <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="2" />
                                <rect x="11" y="7" width="2" height="7" rx="1" fill="#fff" />
                                <rect x="11" y="16" width="2" height="2" rx="1" fill="#fff" />
                            </svg>
                        </x-nav-link>
                    @endif

                    @if (in_array($rol, ['donante', 'receptor']))
                        <x-nav-link :href="route('intercambios.index')" :active="request()->routeIs('intercambios.*')" class="text-white" title="Intercambios">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                style="vertical-align:middle;">
                                <path d="M7 7H17V3M17 3L21 7" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M17 17H7V21M7 21L3 17" stroke="#ffe066" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
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

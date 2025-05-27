<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EcoTrueque - Bienvenido</title>

    <!-- Tipografía -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-color: #ebdba7; font-family: 'Figtree', sans-serif;" class="text-white antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-4xl sm:text-5xl font-bold mb-6 " style="color: #000000;">Bienvenido a <span
                style="color: #45cb20;">EcoTrueque</span></h1>

        <p class="mb-8 text-lg sm:text-xl max-w-2xl" style="color: #000000;">
            Intercambia o dona objetos usados con otros usuarios de forma sostenible y solidaria. ¡Da una segunda vida a
            lo que ya no usas!
        </p>

        <div class="flex gap-4 flex-col sm:flex-row" style="color: #000000">
            <a href="{{ route('register') }}"
                class="bg-[#45F85A] hover:bg-green-500 text-black px-6 py-3 rounded font-semibold transition">
                Registrarse
            </a>

            <a href="{{ route('login') }}"
                class="bg-[#94D7FB] hover:bg-blue-400 text-black px-6 py-3 rounded font-semibold transition">
                Iniciar sesión
            </a>
        </div>

        <footer class="mt-16 text-sm" style="color: #000000">
            &copy; {{ date('Y') }} EcoTrueque. Todos los derechos reservados.
        </footer>
    </div>
</body>

</html>

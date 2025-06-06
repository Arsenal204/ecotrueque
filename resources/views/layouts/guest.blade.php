<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcoTrueque') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-white" style=" background: linear-gradient(100deg, #e2cc82 60%, #b6e388 100%);">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4 sm:px-6 lg:px-8">

        <!-- Logo o nombre -->
        <div class="mb-6">
            <a href="{{ url('/') }}" class="text-3xl font-bold text-white">
                EcoTrueque
            </a>
        </div>

        <!-- Contenido (formulario login/register) -->
        <div class="w-full max-w-md  p-8 rounded-lg shadow-lg text-black dark:text-white"
            style="background-color: #e2cc82">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

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

<body
    style="background: linear-gradient(100deg, #e2cc82 60%, #b6e388 100%); font-family: 'Figtree', sans-serif; min-height:100vh; margin:0; padding:0;">
    <div style="min-height:100vh; display:flex; align-items:center; justify-content:center; color:#222;">
        <div
            style="background:rgba(255,255,255,0.95); border-radius:1rem; box-shadow:0 8px 32px 0 rgba(34,139,34,0.15); max-width:420px; width:100%; padding:2.5rem 2rem; text-align:center; border:1px solid #b6e388;">
            <h1 style="font-size:2.5rem; font-weight:800; margin-bottom:1.5rem; color:#222;">
                Bienvenido a <span style="color: #45cb20;">EcoTrueque</span>
            </h1>

            <p style="margin-bottom:2rem; font-size:1.15rem; color:#444;">
                Intercambia o dona objetos usados con otros usuarios de forma sostenible y solidaria.<br>
                ¡Da una segunda vida a lo que ya no usas!
            </p>

            <div style="display:flex; flex-direction:column; gap:1rem; align-items:center; justify-content:center;">
                <a href="{{ route('register') }}"
                    style="background:#45F85A; color:#222; font-size:1rem; font-weight:600; padding:0.75rem 2.5rem; border-radius:0.5rem; margin-bottom:0.5rem; text-decoration:none; box-shadow:0 2px 8px 0 rgba(34,139,34,0.10); border:none; transition:background 0.2s;"
                    onmouseover="this.style.background='#76a03b'; this.style.color='#fff';"
                    onmouseout="this.style.background='#45F85A'; this.style.color='#222';">
                    Registro
                </a>
                <a href="{{ route('login') }}"
                    style="background:#94D7FB; color:#222; font-size:1rem; font-weight:600; padding:0.75rem 2.5rem; border-radius:0.5rem; text-decoration:none; box-shadow:0 2px 8px 0 rgba(34,139,34,0.10); border:none; transition:background 0.2s;"
                    onmouseover="this.style.background='#45cb20'; this.style.color:'#fff';"
                    onmouseout="this.style.background='#94D7FB'; this.style.color='#222';">
                    Iniciar Sesión
                </a>
                <a href="{{ route('github.login') }}"
                    class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded inline-block">
                    Iniciar sesión con GitHub
                </a>

            </div>
        </div>
    </div>

    <footer style="margin-top:2rem; text-align:center; font-size:0.95rem; color:#222;">
        &copy; {{ date('Y') }} EcoTrueque. Todos los derechos reservados.
    </footer>
</body>

</html>

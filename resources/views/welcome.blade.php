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
                    style="background:#222; color:#fff; font-size:1rem; font-weight:600; padding:0.75rem 2.5rem; border-radius:0.5rem; text-decoration:none; box-shadow:0 2px 8px 0 rgba(34,139,34,0.10); border:none; display:inline-flex; align-items:center; gap:0.7rem; transition:background 0.2s;"
                    onmouseover="this.style.background='#444';" onmouseout="this.style.background='#222';">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                        style="vertical-align:middle;">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 2C6.48 2 2 6.58 2 12.26c0 4.48 2.87 8.28 6.84 9.63.5.09.68-.22.68-.48 0-.24-.01-.87-.01-1.7-2.78.62-3.37-1.36-3.37-1.36-.45-1.18-1.1-1.5-1.1-1.5-.9-.63.07-.62.07-.62 1 .07 1.53 1.05 1.53 1.05.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.37-2.22-.26-4.56-1.14-4.56-5.07 0-1.12.39-2.03 1.03-2.75-.1-.26-.45-1.3.1-2.7 0 0 .84-.28 2.75 1.05A9.38 9.38 0 0 1 12 6.84c.85.004 1.71.12 2.51.35 1.91-1.33 2.75-1.05 2.75-1.05.55 1.4.2 2.44.1 2.7.64.72 1.03 1.63 1.03 2.75 0 3.94-2.34 4.81-4.57 5.07.36.32.68.94.68 1.9 0 1.37-.01 2.47-.01 2.81 0 .27.18.58.69.48C19.13 20.54 22 16.74 22 12.26 22 6.58 17.52 2 12 2Z"
                            fill="#fff" />
                    </svg>
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

<x-app-layout>
    <div
        style="max-width:900px; margin:3rem auto; background:#e2cc82; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#222;">
        <h1 style="font-size:2rem; font-weight:700; margin-bottom:1.5rem; color:#5C3F94; text-align:center;">
            Política de Privacidad
        </h1>

        <p style="margin-bottom:1.5rem;">
            En <strong>EcoTrueque</strong> nos comprometemos a proteger tu privacidad. Esta política explica cómo
            recopilamos,
            usamos y protegemos la información que nos proporcionas.
        </p>

        <h2 style="font-size:1.2rem; font-weight:700; margin-top:2rem; margin-bottom:0.7rem; color:#76a03b;">
            1. Responsable del tratamiento
        </h2>
        <p style="margin-bottom:1.2rem;">
            EcoTrueque - Contacto: <a href="mailto:diegorobles031204@gmail.com"
                style="color:#b4007c; text-decoration:underline;">diegorobles031204@gmail.com</a>
        </p>

        <h2 style="font-size:1.2rem; font-weight:700; margin-top:2rem; margin-bottom:0.7rem; color:#76a03b;">
            2. Datos que recopilamos
        </h2>
        <ul class="list-disc pl-6 mb-4">
            <li>Nombre completo</li>
            <li>Correo electrónico</li>
            <li>Dirección y ciudad</li>
            <li>Teléfono (opcional)</li>
            <li>Información de navegación (cookies)</li>
        </ul>

        <h2 style="font-size:1.2rem; font-weight:700; margin-top:2rem; margin-bottom:0.7rem; color:#76a03b;">
            3. Finalidad del tratamiento
        </h2>
        <p class="mb-4">Los datos se utilizan para:</p>
        <ul class="list-disc pl-6 mb-4">
            <li>Gestionar el registro y acceso a la plataforma</li>
            <li>Facilitar el contacto entre usuarios para intercambios o donaciones</li>
            <li>Enviar comunicaciones relevantes (previo consentimiento)</li>
            <li>Mejorar el funcionamiento y seguridad de la web</li>
        </ul>

        <h2 style="font-size:1.2rem; font-weight:700; margin-top:2rem; margin-bottom:0.7rem; color:#76a03b;">
            4. Derechos del usuario
        </h2>
        <p class="mb-4">Puedes ejercer tus derechos de acceso, rectificación, cancelación u oposición escribiendo a:
            <a href="mailto:diegorobles031204@gmail.com"
                class="underline text-purple-800">diegorobles031204@gmail.com</a>
        </p>

        <h2 style="font-size:1.2rem; font-weight:700; margin-top:2rem; margin-bottom:0.7rem; color:#76a03b;">
            5. Conservación de los datos
        </h2>
        <p class="mb-4">Tus datos se conservarán mientras tengas una cuenta activa. Si la eliminas, eliminaremos tus
            datos conforme a las obligaciones legales.</p>

        <h2 style="font-size:1.2rem; font-weight:700; margin-top:2rem; margin-bottom:0.7rem; color:#76a03b;">
            6. Seguridad
        </h2>
        <p class="mb-4">Aplicamos medidas técnicas y organizativas adecuadas para proteger tu información.</p>

        <hr class="my-6 border-gray-400">

        <h2 class="text-xl font-bold mb-3">Política de Cookies</h2>

        <p class="mb-4">Utilizamos cookies para mejorar tu experiencia como usuario. Las cookies son pequeños archivos
            que se almacenan en tu navegador y nos permiten:</p>
        <ul class="list-disc pl-6 mb-4">
            <li>Recordar tus preferencias</li>
            <li>Analizar el tráfico y uso del sitio web</li>
            <li>Mantener tu sesión iniciada</li>
        </ul>

        <p class="mb-4">Puedes configurar tu navegador para rechazar cookies o eliminarlas en cualquier momento. Al
            usar
            nuestra web, aceptas el uso de cookies según lo descrito.</p>

        <p class="mt-6 text-sm text-black">Última actualización: {{ now()->format('d/m/Y') }}</p>
    </div>
</x-app-layout>

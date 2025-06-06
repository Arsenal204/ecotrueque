<div style="font-family:sans-serif; color:#222;">
    <h2>Mensaje desde el formulario de contacto</h2>

    <p><strong>Nombre:</strong> {{ $datos['nombre'] }}</p>
    <p><strong>Email:</strong> {{ $datos['email'] }}</p>
    <p><strong>Mensaje:</strong></p>
    <p style="background:#f9fafb; padding:1rem; border:1px solid #ccc;">
        {{ $datos['mensaje'] }}
    </p>
</div>

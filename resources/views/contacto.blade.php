<x-app-layout>
    <div
        style="max-width:600px; margin:3rem auto; background:#e2cc82; border-radius:1rem; box-shadow:0 4px 16px rgba(34,139,34,0.10); padding:2.5rem 2rem; color:#222;">
        <h1 style="font-size:2rem; font-weight:700; margin-bottom:1.5rem; color:#5C3F94; text-align:center;">
            Contacto
        </h1>
        <p style="margin-bottom:1.5rem; text-align:center;">
            ¿Tienes dudas o sugerencias? Rellena el siguiente formulario o escríbenos directamente a
            <a href="mailto:diegorobles031204@gmail.com"
                style="color:#b4007c; text-decoration:underline;"><strong>diegorobles031204@gmail.com</strong></a>.
        </p>

        <form action="{{ route('contacto.enviar') }}" method="POST">
            @csrf
            <div style="margin-bottom:1.2rem;">
                <label for="nombre"
                    style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Nombre</label>
                <input type="text" name="nombre" id="nombre" required
                    style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                    onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                    onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
            </div>
            <div style="margin-bottom:1.2rem;">
                <label for="email"
                    style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Correo
                    electrónico</label>
                <input type="email" name="email" id="email" required
                    style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                    onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                    onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
            </div>
            <div style="margin-bottom:1.2rem;">
                <label for="mensaje"
                    style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Mensaje</label>
                <textarea name="mensaje" id="mensaje" rows="4" required
                    style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; resize:vertical; transition:box-shadow 0.2s, border-color 0.2s;"
                    onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                    onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';"></textarea>
            </div>
            <button type="submit"
                style="background:#76a03b; color:#fff; font-weight:700; padding:0.7rem 2rem; border-radius:0.5rem; border:none; font-size:1rem; transition:background 0.2s; cursor:pointer;"
                onmouseover="this.style.background='#5C3F94';" onmouseout="this.style.background='#76a03b';">
                Enviar
            </button>
        </form>
    </div>
</x-app-layout>

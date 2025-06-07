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
        <div style="margin-top: 2rem;">
            <h2 style="font-size:1.3rem; font-weight:700; color:#5C3F94; margin-bottom:1rem;">
                Nuestra ubicación
            </h2>
            <div style="border: 2px solid #ccc; border-radius: 1rem; overflow: hidden;">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3225.588744446748!2d-6.33899652427036!3d36.79828547350459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0de0bb1ab0e7cb%3A0xc05bb3c6ccc40a8b!2sC.%20Botavara%2C%2010%2C%2011540%20Bonanza%2C%20C%C3%A1diz!5e0!3m2!1ses!2ses!4v1717780421491!5m2!1ses!2ses"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>


        <form action="{{ route('contacto.enviar') }}" method="POST">
            @csrf
            <div style="margin-bottom:1.2rem;">
                <label for="nombre"
                    style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Nombre</label>
                <input type="text" name="nombre" id="nombre" required
                    value="{{ old('nombre', Auth::user()->name ?? '') }}"
                    style="width:100%; padding:0.7rem; border-radius:0.5rem; border:1px solid #ccc; background:#f9fafb; color:#222; font-size:1rem; transition:box-shadow 0.2s, border-color 0.2s;"
                    onfocus="this.style.boxShadow='0 0 0 2px #b6e388'; this.style.borderColor='#76a03b';"
                    onblur="this.style.boxShadow='none'; this.style.borderColor='#ccc';">
            </div>
            <div style="margin-bottom:1.2rem;">
                <label for="email"
                    style="display:block; font-weight:600; color:#5C3F94; margin-bottom:0.3rem;">Correo
                    electrónico</label>
                <input type="email" name="email" id="email" required
                    value="{{ old('email', Auth::user()->email ?? '') }}"
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






    </div>
</x-app-layout>

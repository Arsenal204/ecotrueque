<footer class="bg-[#B4007C] text-white mt-10">
    <div class="max-w-7xl mx-auto py-6 px-4 flex flex-col text-black sm:flex-row justify-between items-center">
        <p class="text-sm">&copy; {{ date('Y') }} EcoTrueque. Todos los derechos reservados.</p>

        <div class="flex text-black space-x-4 mt-2 sm:mt-0">
            <a href="{{ route('aviso.legal') }}">Aviso Legal---</a>
            <a href="{{ route('politica.privacidad') }}">Política de Privacidad---</a>
            <a href="{{ route('contacto') }}">Contacto</a>

        </div>
    </div>
</footer>

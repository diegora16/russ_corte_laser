@extends('layouts.layoutUsuario')

@section('yield', 'Contacto')

@section('content')

    <section>
        <div class="mb-8">
            <h1 class="font-medium text-5xl text-white w-min bg-blue-950 px-5 py-3 rounded-full mx-auto">Contacto</h1>
        </div>
        
        <div class="flex flex-wrap md:flex-nowrap gap-8 px-4">
            <!-- Teléfonos y Correo -->
            <div class="flex-1">
                <h2 class="text-4xl md:text-4xl font-bold text-blue-950 mb-4 text-center">Teléfonos</h2>
                <p class="mt-3 mx-2 text-center md:text-xl leading-loose text-gray-600">Contáctanos directamente por WhatsApp:</p>
                <div class="flex justify-center mt-6">
                    {{-- Botón de WhatsApp grande --}}
                    <a href="https://wa.link/mdtsyx" target="_blank">
                        <button class="flex items-center bg-green-700 border-0 py-4 px-10 focus:outline-none hover:bg-green-800 rounded-full text-2xl text-white font-bold">
                            <i class="fa-brands fa-whatsapp mr-3 text-4xl"></i>
                            Escríbenos en WhatsApp
                        </button>
                    </a>
                </div>

                <!-- Correo -->
                <h2 class="text-4xl md:text-4xl font-bold text-blue-950 mb-4 text-center mt-10">Email</h2>
                <p class="mt-3 mx-2 text-center md:text-xl leading-loose text-gray-600">Correo disponible:</p>
                <p class="mx-2 text-center text-xl leading-loose text-blue-800">russcortelaser@gmail.com</p>
            </div>

            <!-- Mapa -->
            <div class="flex-1">
                <h2 class="text-4xl md:text-4xl font-bold text-blue-950 mb-4 text-center">Ubicación</h2>
                <p class="mt-3 mx-2 text-center md:text-xl leading-loose text-gray-600">Encuéntranos en:</p>
                <p class="mx-2 text-center text-xl leading-loose text-blue-800">Prol. Av. Perú 1551, Trujillo 13006</p>
                <div class="mt-6">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3900.517333988343!2d-79.03507562506658!3d-8.108768582695434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad3cfc3a64a00d%3A0x92cf48035f44bd7e!2sProl.%20Av.%20Per%C3%BA%201551%2C%20Trujillo%2013006%2C%20Per%C3%BA!5e0!3m2!1ses-419!2s!4v1698771132168!5m2!1ses-419!2s&disableDefaultUI=true" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

@endsection

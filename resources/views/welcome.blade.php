@extends('layouts.layoutUsuario')

@section('title', 'Bienvenidos')

@section('content')
    <div class="justify-start items-start md:pt-3">
        <div class="text-left px-5 md:ml-10">
            <div class="flex flex-col md:flex-row"> <!-- Flex en columnas para pantallas pequeñas -->
                <h1 class="text-4xl md:text-5xl font-bold text-blue-950 mb-4">
                    ¡Hola estimados Clientes!
                </h1> 
                <img src="/img/flag_peru.svg" alt="flagPeru" class="w-28 h-20 p-2 -mt-3 md:ml-2" /> <!-- Margen solo en pantallas grandes -->
            </div>

            <div>
                <h2 class="text-2xl md:text-4xl font-medium text-blue-950">
                    Consigue el mejor diseño para tus 
                    <span id="changing-word" class="font-bold text-red-600"></span><span id="cursor" class="blinking-cursor">|</span> <!-- Cursor añadido -->
                </h2>
            </div>

            <div class="mt-16 flex flex-col md:flex-row"> <!-- Flex en columnas para pantallas pequeñas -->
                <div>
                    <ul class="list-disc pl-5">
                        <li class="text-xl text-gray-700 mb-6">Recordatorios para eventos especiales.</li>
                        <li class="text-xl text-gray-700 mb-6">Grabados y cortes en madera.</li>
                        <li class="text-xl text-gray-700 mb-6">Relojes, lámparas, trofeos y más.</li>
                        <li class="text-xl text-gray-700 mb-6">Regalos y decoraciones personalizadas.</li>
                        <li class="text-xl text-gray-700 mb-6">+9 años de experiencia en calidad láser.</li>
                    </ul>

                    <a href="/Tienda">
                        <button class="inline-flex items-center bg-blue-900 border-0 py-3 px-9 focus:outline-none hover:bg-blue-950 rounded-full text-4xl mt-4 md:mt-10 text-white font-bold">
                            Ver catálogo
                            <i class="fa-solid fa-right-long ml-2 mt-1 text-5xl"></i>
                        </button>
                    </a>
                </div>

                <div class="md:-mt-10 md:ml-[35rem] mt-10 md:mx-0 mx-6"> <!-- Ajuste del margen superior y margen izquierdo solo en pantallas grandes -->
                    <img id="dynamic-image" src="/img/ironman.png" class="w-full max-w-lg h-auto p-2 md:-mt-10 rounded-lg">
                </div>
            </div>
        </div>
    </div>

    <script>
        // Lista de palabras para el efecto de escritura animada
        const words = ["recordatorios.", "trofeos.", "relojes.", "lámparas."];
        let wordIndex = 0;
        let currentWord = '';
        let letterIndex = 0;
        const typingSpeed = 100;
        const erasingSpeed = 75;
        const delayBetweenWords = 1500;
        const changingWordElement = document.getElementById('changing-word');
        const cursorElement = document.getElementById('cursor');

        function type() {
            if (letterIndex === 0 && currentWord === '') {
                currentWord = words[wordIndex].charAt(letterIndex);
                letterIndex++;
                changingWordElement.textContent = currentWord;
                setTimeout(type, typingSpeed);
            } else if (letterIndex < words[wordIndex].length) {
                currentWord += words[wordIndex].charAt(letterIndex);
                changingWordElement.textContent = currentWord;
                letterIndex++;
                setTimeout(type, typingSpeed);
            } else {
                setTimeout(erase, delayBetweenWords);
            }
        }

        function erase() {
            if (letterIndex > 0) {
                currentWord = currentWord.slice(0, letterIndex - 1);
                changingWordElement.textContent = currentWord;
                letterIndex--;
                setTimeout(erase, erasingSpeed);
            } else {
                wordIndex = (wordIndex + 1) % words.length;
                setTimeout(type, typingSpeed);
            }
        }

        // Inicializa el efecto de escritura
        document.addEventListener('DOMContentLoaded', () => {
            type();
        });

        // Lista de imágenes para el cambio dinámico
        const images = [
            "/img/ironman.png",
            "/img/restaurante.png",
            "/img/promocion.png",
            "/img/matrimonio.png",
            "/img/goku.png"
        ];

        let imageIndex = 1; // Comienza desde la segunda imagen
        const dynamicImageElement = document.getElementById("dynamic-image");

        // Función para cambiar la imagen
        function changeImage() {
            dynamicImageElement.src = images[imageIndex];
            imageIndex = (imageIndex + 1) % images.length; // Cicla entre las imágenes
        }

        // Cambiar la imagen cada 2 segundos
        setInterval(changeImage, 2000);
    </script>

    <style>
        .blinking-cursor {
            font-weight: 100;
            font-size: 2xl;
            color: #1e40af;
            animation: blink 0.7s step-start infinite;
        }

        @keyframes blink {
            50% { opacity: 0; }
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            h1 {
                font-size: 2xl;
            }

            h2 {
                font-size: 1.5xl;
            }

            .blinking-cursor {
                font-size: 1.5xl;
            }

            #dynamic-image {
                width: 100%;
                max-width: 100%;
                height: auto;
            }
        }

        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Evitar scroll horizontal */
        }
    </style>
@endsection

@extends('layouts.layoutUsuario')

@section('yield', 'Nosotros')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="font-medium text-5xl text-white w-min bg-blue-950 px-5 py-3 rounded-full mx-auto">Nosotros</h1>
            <p class="mt-3 mx-2 text-center md:text-xl leading-loose text-gray-600">
            En RUSS CORTE LASER, somos expertos en trabajos de láser, router y fiber láser. Realizamos grabados y cortes en materiales como acrílico, MDF, madera, triplay y más. También ofrecemos grabado láser en vidrio, metales, mármol, granito y otros. Con más de 9 años de experiencia, garantizamos calidad, precisión y soluciones personalizadas para cada proyecto.
            </p>
        </div>

        <div class="flex flex-wrap justify-center mt-18">
            <div class="bg-gray-50 p-8 rounded-lg shadow-lg max-w-xs mx-2 mb-4 text-center">
                <i class="fa-regular fa-handshake text-8xl text-blue-950 mb-4"></i>
                <h1 class="text-blue-950 font-bold text-2xl">Compromiso</h1>
                <p class="text-center mt-4 text-gray-600">
                    Nos dedicamos a transformar tus ideas en piezas únicas, ofreciendo un servicio personalizado y cuidando cada detalle en cada proyecto.
                </p>
            </div>

            <div class="bg-gray-50 p-8 rounded-lg shadow-lg max-w-xs mx-2 mb-4 text-center">
                <i class="fa-solid fa-circle-check text-8xl text-blue-950 mb-4"></i>
                <h1 class="text-blue-950 font-bold text-2xl">Calidad</h1>
                <p class="text-center mt-4 text-gray-600">
                    Utilizamos tecnología de punta y materiales de alta calidad para garantizar acabados impecables en cada uno de nuestros productos.
                </p>
            </div>

            <div class="bg-gray-50 p-8 rounded-lg shadow-lg max-w-xs mx-2 mb-4 text-center">
                <i class="fa-solid fa-palette text-8xl text-blue-950 mb-4"></i>
                <h1 class="text-blue-950 font-bold text-2xl">Creatividad</h1>
                <p class="text-center mt-4 text-gray-600">
                    Diseñamos soluciones únicas y originales que se adaptan a tus necesidades, haciendo que cada pieza sea especial y memorable.
                </p>
            </div>

            <div class="bg-gray-50 p-8 rounded-lg shadow-lg max-w-xs mx-2 mb-4 text-center">
                <i class="fa-solid fa-ranking-star text-8xl text-blue-950 mb-4"></i>
                <h1 class="text-blue-950 font-bold text-2xl">Excelencia</h1>
                <p class="text-center mt-4 text-gray-600">
                    Nos esforzamos por superar tus expectativas en cada proyecto, asegurando que nuestros productos sean perfectos en cada detalle.
                </p>
            </div>
        </div>
    </div>
@endsection

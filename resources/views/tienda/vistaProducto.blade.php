@extends('layouts.layoutUsuario')

@section('yield', 'Producto')

@section('content')

<section class="px-4 md:mt-0 -mt-12 md:-mb-14 mb-0">

    <!-- Contenedor principal -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-wrap md:flex-nowrap gap-8">
        <!-- Para móviles: Imagen principal y miniaturas primero -->
        <div class="block md:hidden">
            <!-- Imagen principal -->
            <img id="main-image" src="{{ $producto->imagenes->first()->ruta ?? '/img/default.jpg' }}" alt="{{ $producto->nombre }}" class="w-full h-96 object-cover rounded-lg mb-4 shadow-md">

            <!-- Miniaturas -->
            <div class="flex gap-3">
                @foreach ($producto->imagenes as $imagen)
                    <img src="{{ $imagen->ruta }}" alt="Imagen del Producto" class="w-20 h-20 object-cover rounded cursor-pointer border border-gray-300 hover:border-blue-500" onclick="changeImage('{{ $imagen->ruta }}')">
                @endforeach
            </div>
        </div>

        <!-- Información del producto -->
        <div class="flex-1">
            <h2 class="text-3xl font-bold text-blue-950 mb-4 text-center md:text-left">{{ $producto->nombre }}</h2>
            <p class="text-xl text-green-700 font-semibold mb-4 text-center md:text-left">S/ {{ number_format($producto->precio, 2) }}</p>
            <p class="text-gray-600 mb-6 text-center md:text-left">
                {{ $producto->descripcion }}
            </p>

            <!-- Selección de cantidad -->
            <div class="mb-6 text-center md:text-left">
                <label for="quantity" class="text-lg font-bold text-gray-700">Cantidad:</label>
                <input id="quantity" type="number" value="1" min="1" class="w-20 border rounded px-3 py-2 ml-3 text-gray-700">
                <button id="add-to-cart-btn" class="bg-green-500 text-white py-3 px-6 rounded-md hover:bg-green-700 transition flex items-center justify-center text-lg mb-6 mt-4">
                    <i class="fa-solid fa-plus text-xl mr-2"></i> Añadir al carrito
                </button>
            </div>
        </div>

        <!-- Para escritorio: Imagen principal y miniaturas a la izquierda -->
        <div class="hidden md:block flex-1">
            <!-- Imagen principal -->
            <img id="main-image" src="{{ $producto->imagenes->first()->ruta ?? '/img/default.jpg' }}" alt="{{ $producto->nombre }}" class="w-full h-96 object-cover rounded-lg mb-4 shadow-md">

            <!-- Miniaturas -->
            <div class="flex gap-3">
                @foreach ($producto->imagenes as $imagen)
                    <img src="{{ $imagen->ruta }}" alt="Imagen del Producto" class="w-20 h-20 object-cover rounded cursor-pointer border border-gray-300 hover:border-blue-500" onclick="changeImage('{{ $imagen->ruta }}')">
                @endforeach
            </div>
        </div>
    </div>

    <!-- Botón para regresar a la tienda -->
    <div class="mt-8 text-center">
        <a href="{{ route('tienda.index') }}" class="inline-flex items-center bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition text-lg">
            <i class="fa-solid fa-arrow-left mr-2"></i> Regresar a la tienda
        </a>
    </div>
</section>

<!-- Popup -->
<div id="popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div id="popup-content" class="bg-white p-6 rounded-lg shadow-lg text-center transform scale-90 transition-transform duration-300">
        <i class="fa-solid fa-circle-check text-green-500 text-4xl mb-4"></i>
        <h2 class="text-2xl font-bold text-blue-950 mb-4">Producto añadido al carrito</h2>
        <button id="close-popup" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
            Listo
        </button>
    </div>
</div>

<script>
    // Cambiar la imagen principal al hacer clic en una miniatura
    function changeImage(imageUrl) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = imageUrl;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const quantityInput = document.getElementById('quantity');
        const popup = document.getElementById('popup');
        const popupContent = document.getElementById('popup-content');
        const closePopup = document.getElementById('close-popup');
        const cartCount = document.getElementById('cart-count');
        const productoId = {{ $producto->id }};

        const actualizarContadorCarrito = async () => {
            try {
                const response = await fetch("{{ route('carrito.contar') }}");
                const data = await response.json();
                cartCount.textContent = data.count || 0;
            } catch (error) {
                console.error('Error al actualizar el contador del carrito:', error);
            }
        };

        addToCartBtn.addEventListener('click', async function () {
            const cantidad = parseInt(quantityInput.value, 10);

            if (cantidad < 1) {
                alert('Por favor, selecciona una cantidad válida.');
                return;
            }

            try {
                const response = await fetch("{{ route('carrito.agregar') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        producto_id: productoId,
                        cantidad: cantidad
                    })
                });

                if (response.ok) {
                    await actualizarContadorCarrito();

                    // Mostrar el popup con animación
                    popup.classList.remove('hidden');
                    setTimeout(() => {
                        popup.classList.add('opacity-100');
                        popupContent.classList.add('scale-100');
                    }, 10);
                } else {
                    alert('Error al añadir el producto al carrito.');
                }
            } catch (error) {
                console.error('Error al conectar con el servidor:', error);
            }
        });

        closePopup.addEventListener('click', function () {
            popupContent.classList.remove('scale-100');
            popup.classList.remove('opacity-100');
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 300);
        });
    });
</script>

@endsection

@extends('layouts.layoutUsuario')

@section('yield', 'Tienda')

@section('content')

<section class="px-4">
    <div class="mb-8">
        <h1 class="font-medium text-5xl text-white w-min bg-blue-950 px-5 py-3 rounded-full mx-auto">Tienda</h1>
    </div>

    <!-- Filtro desplegable -->
    <div class="text-center mb-10">
        <label for="product-filter" class="text-xl font-bold text-blue-950">Filtrar por tipo de producto:</label>
        <select id="product-filter" class="mt-3 bg-white border border-gray-300 rounded-lg shadow-md text-gray-700 px-4 py-2 w-full md:w-1/2 lg:w-1/3 text-lg focus:outline-none focus:ring-2 focus:ring-blue-950">
            <option value="todos">Todos</option>
            @foreach ($categorias as $categoria)
                <option value="{{ strtolower($categoria->nombre) }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Lista de productos -->
    <div id="product-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($productos as $producto)
            <div class="product-card {{ strtolower($producto->categoria->nombre ?? 'sin-categoria') }} bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition flex flex-col">
                <div class="flex-shrink-0">
                    <img src="{{ $producto->imagenes->first() ? asset($producto->imagenes->first()->ruta) : '/img/default.jpg' }}" 
                        alt="{{ $producto->nombre }}" 
                        class="w-full h-56 object-cover rounded-md mb-4">
                </div>
                <div class="flex-grow">
                    <h3 class="text-2xl font-bold text-blue-950 mb-2">{{ $producto->nombre }}</h3>
                    <p class="text-xl font-semibold text-green-700 mb-4">S/ {{ number_format($producto->precio, 2) }}</p>
                    <p class="text-gray-600 mb-4">{{ Str::limit($producto->descripcion, 60) }}</p>
                </div>
                <div class="flex justify-between items-center mt-auto">
                    <!-- Formulario para agregar al carrito -->
                    <form action="{{ route('carrito.agregar') }}" method="POST" class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700 transition flex items-center text-lg">
                            <i class="fa-solid fa-plus text-xl mr-2"></i> Agregar al carrito
                        </button>
                    </form>
                    <a href="{{ route('producto.detalle', $producto->id) }}" class="text-blue-950 font-bold hover:underline">Leer más</a>
                </div>
            </div>
        @endforeach
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
    document.addEventListener('DOMContentLoaded', function () {
        const filter = document.getElementById('product-filter');
        const productCards = document.querySelectorAll('.product-card');

        filter.addEventListener('change', function () {
            const selectedCategory = filter.value;

            productCards.forEach(card => {
                if (selectedCategory === 'todos') {
                    card.style.display = 'block';
                } else if (card.classList.contains(selectedCategory)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        const forms = document.querySelectorAll('.add-to-cart-form');
        const popup = document.getElementById('popup');
        const popupContent = document.getElementById('popup-content');
        const closePopup = document.getElementById('close-popup');

        const actualizarContadorCarrito = async () => {
            try {
                const response = await fetch("{{ route('carrito.contar') }}");
                const data = await response.json();
                document.getElementById('cart-count').textContent = data.count || 0;
            } catch (error) {
                console.error('Error al actualizar el contador del carrito:', error);
            }
        };

        forms.forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ route('carrito.agregar') }}", {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                        body: formData
                    });
                    if (response.ok) {
                        await actualizarContadorCarrito();
                        popup.classList.remove('hidden');
                        setTimeout(() => {
                            popup.classList.add('opacity-100');
                            popupContent.classList.add('scale-100');
                        }, 10);
                    } else {
                        alert("Error al agregar el producto al carrito.");
                    }
                } catch (error) {
                    console.error(error);
                    alert("Error al agregar el producto al carrito.");
                }
            });
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

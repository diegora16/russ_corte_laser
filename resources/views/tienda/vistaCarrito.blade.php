@extends('layouts.layoutUsuario')

@section('yield', 'Mi Carrito')

@section('content')

<section class="px-4">
    <div class="mb-8 text-center">
        <h1 class="font-medium text-5xl text-white bg-blue-950 px-10 py-3 rounded-full inline-flex items-center">
            <i class="fa-solid fa-cart-shopping mr-3 text-white"></i> Mi Carrito
        </h1>
    </div>

    <!-- Vista en PC: Tabla -->
    <div class="bg-white p-6 rounded-lg shadow-md hidden md:block">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Producto</th>
                    <th class="py-2 px-4 border-b">Precio</th>
                    <th class="py-2 px-4 border-b">Cantidad</th>
                    <th class="py-2 px-4 border-b">Total</th>
                    <th class="py-2 px-4 border-b text-center">Acciones</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                @foreach ($productos as $producto)
                    <tr data-precio="{{ $producto->precio }}" data-id="{{ $producto->id }}">
                        <td class="py-2 px-4 border-b flex items-center">
                            <img src="{{ $producto->imagenes->first() ? asset($producto->imagenes->first()->ruta) : '/img/default.jpg' }}" 
                                alt="{{ $producto->nombre }}" class="w-16 h-16 object-cover rounded mr-4">
                            <span>{{ $producto->nombre }}</span>
                        </td>
                        <td class="py-2 px-4 border-b">S/ {{ number_format($producto->precio, 2) }}</td>
                        <td class="py-2 px-4 border-b">
                            <input type="number" value="{{ $producto->cantidad }}" class="cantidad w-16 border rounded px-2 py-1" min="1">
                        </td>
                        <td class="py-2 px-4 border-b total-item">S/ {{ number_format($producto->precio * $producto->cantidad, 2) }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <button class="delete-button text-red-500 hover:text-red-700" data-id="{{ $producto->id }}">
                                <i class="fa-solid fa-trash text-xl"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Vista en móvil: Tarjetas -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @foreach ($productos as $producto)
            <div class="bg-white p-4 rounded-lg shadow-md" data-precio="{{ $producto->precio }}" data-id="{{ $producto->id }}">
                <div class="flex items-center mb-4">
                    <img src="{{ $producto->imagenes->first() ? asset($producto->imagenes->first()->ruta) : '/img/default.jpg' }}" 
                        alt="{{ $producto->nombre }}" class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <h2 class="text-lg font-bold text-blue-950">{{ $producto->nombre }}</h2>
                        <p class="text-green-700 font-semibold">S/ {{ number_format($producto->precio, 2) }}</p>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="cantidad-{{ $producto->id }}" class="text-gray-700 font-bold">Cantidad:</label>
                    <input id="cantidad-{{ $producto->id }}" type="number" value="{{ $producto->cantidad }}" class="cantidad w-16 border rounded px-2 py-1 ml-2" min="1">
                </div>
                <p class="mb-4 text-gray-700">Total: <span class="total-item font-bold">S/ {{ number_format($producto->precio * $producto->cantidad, 2) }}</span></p>
                <div class="flex justify-between items-center">
                    <button class="delete-button text-red-500 hover:text-red-700" data-id="{{ $producto->id }}">
                        <i class="fa-solid fa-trash text-xl"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Total y Botones -->
    <div class="mt-6 flex justify-between items-center flex-wrap gap-4">
        <a href="{{ route('tienda.index') }}" class="text-blue-600 hover:text-blue-800 text-lg font-semibold flex items-center">
            <i class="fa-solid fa-arrow-left-long mr-2"></i> Volver a la tienda
        </a>

        <div class="flex gap-4 items-center">
            <div class="text-2xl font-bold text-blue-950">
                Total: <span id="total-compra">S/ 0.00</span>
            </div>
            <a href="{{ route('carrito.proceder') }}" class="bg-green-500 text-white py-3 px-8 rounded-md hover:bg-green-700 transition inline-flex items-center text-lg font-bold">
                Proceder al Pago <i class="fa-solid fa-arrow-right-long ml-2"></i>
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cantidadInputs = document.querySelectorAll('.cantidad');
        const cartCountSpan = document.getElementById('cart-count');
        const totalCompraSpan = document.getElementById('total-compra');
        const deleteButtons = document.querySelectorAll('.delete-button');

        const calcularTotalCompra = () => {
            let total = 0;
            document.querySelectorAll('#cart-items tr').forEach(row => {
                const precio = parseFloat(row.getAttribute('data-precio'));
                const cantidadInput = row.querySelector('.cantidad');
                const cantidad = parseInt(cantidadInput.value, 10);
                const subtotal = precio * cantidad;

                row.querySelector('.total-item').textContent = `S/ ${subtotal.toFixed(2)}`;
                total += subtotal; 
            });
            totalCompraSpan.textContent = `S/ ${total.toFixed(2)}`;
        };

        const actualizarCantidadEnServidor = async (id, cantidad) => {
            try {
                const response = await fetch(`/Carrito/actualizar/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ cantidad })
                });
                const data = await response.json();
                if (response.ok) {
                    cartCountSpan.textContent = data.totalCount;
                    calcularTotalCompra(); 
                }
            } catch (error) {
                console.error('Error al conectar con el servidor:', error);
            }
        };

        const eliminarProducto = async (id) => {
            try {
                const response = await fetch(`/Carrito/eliminar/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                const data = await response.json();
                if (response.ok) {
                    document.querySelector(`[data-id="${id}"]`).remove();
                    cartCountSpan.textContent = data.totalCount;
                    calcularTotalCompra(); 
                } else {
                    console.error('Error al eliminar el producto.');
                }
            } catch (error) {
                console.error('Error al eliminar el producto:', error);
            }
        };

        cantidadInputs.forEach(input => {
            input.addEventListener('input', function () {
                const id = this.closest('[data-id]').getAttribute('data-id');
                const cantidad = parseInt(this.value, 10);
                if (cantidad > 0) {
                    actualizarCantidadEnServidor(id, cantidad);
                }
            });
        });

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                eliminarProducto(id);
            });
        });

        calcularTotalCompra();
    });
</script>

@endsection

@extends('auth.layout.layoutA')

@section('yield', 'Productos')

@section('content')

<div class="mb-4">
    <a href="{{ route('productos.create') }}" 
       class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">
        AGREGAR PRODUCTO
    </a>
</div>

<div class="p-6">
    <h1 class="text-lg font-bold mb-4">Categorías</h1>

    <!-- Tabla de categorías -->
    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">ID</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Imagen</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Categoría</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Nombre</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Descripción</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Precio</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border border-gray-300">{{ $producto->id }}</td>
                <td class="px-4 py-2 border border-gray-300">
                    @if ($producto->imagenes->isNotEmpty())
                        <img src="{{ asset($producto->imagenes->first()->ruta) }}" alt="Imagen del producto" class="w-16 h-16 object-cover rounded">
                    @else
                        <span class="text-gray-500">Sin imagen</span>
                    @endif
                </td>
                <td class="px-4 py-2 border border-gray-300">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                <td class="px-4 py-2 border border-gray-300">{{ $producto->nombre }}</td>
                <td class="px-4 py-2 border border-gray-300">{{ $producto->descripcion }}</td>
                <td class="px-4 py-2 border border-gray-300">{{ $producto->precio }}</td>
                <td class="px-4 py-2 border border-gray-300">
                    <a href="{{ route('productos.edit', $producto) }}" 
                       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Editar
                    </a>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 ml-2">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

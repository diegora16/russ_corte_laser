@extends('auth.layout.layoutA')

@section('yield', 'Categorias')

@section('content')

<div class="p-4">
    <h1 class="font-bold text-lg mb-4">AGREGAR NUEVA CATEGORÍA</h1>
    <div class="flex items-center space-x-4">
        <form action="{{ route('categorias.store') }}" method="POST" class="flex items-center space-x-2">
            @csrf
            <label for="nombre" class="flex items-center space-x-2">
                <span class="text-gray-700 font-medium">Ingrese la nueva categoría:</span>
                <input type="text" name="nombre" id="nombre" class="border rounded-lg px-3 py-2 text-black w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 mx-3 border-black" required>
            </label>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg">
                Generar
            </button>
        </form>
    </div>
</div>

<div class="p-6">
    <h1 class="text-lg font-bold mb-4">Categorías</h1>

    <!-- Tabla de categorías -->
    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">ID</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Nombre</th>
                <th class="px-4 py-2 border border-gray-300 text-left font-bold">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border border-gray-300">{{ $categoria->id }}</td>
                <td class="px-4 py-2 border border-gray-300">{{ $categoria->nombre }}</td>
                <td class="px-4 py-2 border border-gray-300">
                    <a href="{{ route('categorias.edit', $categoria) }}" 
                       class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Editar
                    </a>
                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">
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

@extends('auth.layout.layoutA')

@section('yield', 'Editar Categoria')

@section('content')

<div class="p-4">
    <h1 class="font-bold text-lg mb-4">EDITAR CATEGORÍA</h1>
    <div class="flex items-center space-x-4">
        <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="flex items-center space-x-2">
            @csrf @method('PATCH')
            <label for="nombre" class="flex items-center space-x-2">
                <span class="text-gray-700 font-medium">Ingrese la nueva categoría:</span>
                <input value="{{old('nombre', $categoria->nombre)}}" type="text" name="nombre" id="nombre" class="border rounded-lg px-3 py-2 text-black w-64 focus:outline-none focus:ring-2 focus:ring-blue-500 mx-3 border-black" required>
            </label>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg">
                CAMBIAR CATEGORIA
            </button>
        </form>
    </div>
</div>

@endsection

@extends('auth.layout.layoutA')

@section('yield', 'Agregar Producto')

@section('content')

<div class="p-4">
    <h1 class="font-bold text-lg mb-4">AGREGAR NUEVO PRODUCTO</h1>
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Campo Nombre -->
        <div>
            <label for="nombre" class="block text-gray-700 font-medium">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                   class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Campo Precio -->
        <div>
            <label for="precio" class="block text-gray-700 font-medium">Precio:</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio') }}" 
                   class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Campo Descripción -->
        <div>
            <label for="descripcion" class="block text-gray-700 font-medium">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" 
                      class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion') }}</textarea>
        </div>

        <!-- Campo Categoría -->
        <div>
            <label for="categoria_id" class="block text-gray-700 font-medium">Categoría:</label>
            <select name="categoria_id" id="categoria_id" 
                    class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled selected>Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Campo Imágenes -->
        <div>
            <label for="imagenes" class="block text-gray-700 font-medium">Imágenes:</label>
            <input type="file" name="imagenes[]" id="imagenes" multiple 
                   class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            <small class="text-gray-500">Puede subir varias imágenes.</small>
        </div>

        <!-- Botón de Enviar -->
        <div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
                AGREGAR
            </button>
        </div>
    </form>
</div>

@endsection

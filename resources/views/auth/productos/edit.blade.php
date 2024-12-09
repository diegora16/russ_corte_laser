@extends('auth.layout.layoutA')

@section('yield', 'Editar Producto')

@section('content')

<div class="p-4">
    <h1 class="font-bold text-lg mb-4">EDITAR PRODUCTO</h1>
    <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PATCH')

        <!-- Campo Nombre -->
        <div>
            <label for="nombre" class="block text-gray-700 font-medium">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" 
                   class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Campo Precio -->
        <div>
            <label for="precio" class="block text-gray-700 font-medium">Precio:</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" 
                   class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Campo Descripción -->
        <div>
            <label for="descripcion" class="block text-gray-700 font-medium">Descripción:</label>
            <textarea name="descripcion" id="descripcion" rows="4" 
                      class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <!-- Campo Categoría -->
        <div>
            <label for="categoria_id" class="block text-gray-700 font-medium">Categoría:</label>
            <select name="categoria_id" id="categoria_id" 
                    class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Campo Imágenes Existentes -->
        <div>
            <label for="imagenes" class="block text-gray-700 font-medium">Imágenes actuales:</label>
            <div class="flex space-x-4">
                @foreach($producto->imagenes as $imagen)
                <img src="{{ asset($imagen->ruta) }}" alt="Imagen actual" class="w-20 h-20 object-cover rounded">
                @endforeach
            </div>
            <small class="text-gray-500">Estas imágenes no se eliminarán a menos que subas nuevas.</small>
        </div>

        <!-- Campo Subir Nuevas Imágenes -->
        <div>
            <label for="imagenes" class="block text-gray-700 font-medium">Subir nuevas imágenes (opcional):</label>
            <input type="file" name="imagenes[]" id="imagenes" multiple 
                   class="border rounded-lg px-3 py-2 text-black w-full focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
            <small class="text-gray-500">Puede subir nuevas imágenes para reemplazar las existentes.</small>
        </div>

        <!-- Botón de Enviar -->
        <div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
                GUARDAR CAMBIOS
            </button>
        </div>
    </form>
</div>

@endsection

<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Obtenemos todos los productos con su categoría e imágenes
        $productos = Producto::with(['categoria', 'imagenes'])->get();

        // Retornamos la vista y pasamos los productos
        return view('auth.productos.index', compact('productos'));
    }

    public function destroy(Producto $producto)
    {
        // Eliminar las imágenes asociadas del producto
        foreach ($producto->imagenes as $imagen) {
            // Eliminar el archivo de la imagen si existe
            if (file_exists(public_path($imagen->ruta))) {
                unlink(public_path($imagen->ruta));
            }

            // Eliminar la imagen de la base de datos
            $imagen->delete();
        }

        // Eliminar el producto de la base de datos
        $producto->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function create()
    {
        $categorias = \App\Models\Categoria::all(); // Obtener todas las categorías
        return view('auth.productos.create', compact('categorias'));
    }


    public function store(Request $request)
{
    // Validar los datos enviados
    $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'descripcion' => 'nullable|string',
        'categoria_id' => 'required|exists:categorias,id',
        'imagenes' => 'required|array', // Validar que sea un array de imágenes
        'imagenes.*' => 'image|mimes:jpeg,png', // Validar cada imagen
    ]);

    // Crear el producto
    $producto = Producto::create([
        'nombre' => $request->nombre,
        'precio' => $request->precio,
        'descripcion' => $request->descripcion,
        'categoria_id' => $request->categoria_id,
    ]);

    // Guardar las imágenes en la carpeta public/img
    if ($request->hasFile('imagenes')) {
        foreach ($request->file('imagenes') as $imagen) {
            // Almacenar la imagen en public/img
            $nombreArchivo = time() . '_' . $imagen->getClientOriginalName(); // Generar nombre único
            $ruta = '/img/' . $nombreArchivo; // Ruta relativa a la carpeta public con prefijo "/"
            $imagen->move(public_path('img'), $nombreArchivo); // Mover la imagen a public/img

            // Guardar la ruta de la imagen en la base de datos
            $producto->imagenes()->create(['ruta' => $ruta]);
        }
    }

    // Redirigir con mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente.');
}


public function edit(Producto $producto)
{
    $categorias = \App\Models\Categoria::all(); // Obtener todas las categorías
    return view('auth.productos.edit', compact('producto', 'categorias'));
}

public function update(Request $request, Producto $producto)
{
    // Validar los datos enviados
    $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'descripcion' => 'nullable|string',
        'categoria_id' => 'required|exists:categorias,id',
        'imagenes.*' => 'image|mimes:jpeg,png', // Validar cada imagen
    ]);

    // Actualizar los datos del producto
    $producto->update([
        'nombre' => $request->nombre,
        'precio' => $request->precio,
        'descripcion' => $request->descripcion,
        'categoria_id' => $request->categoria_id,
    ]);

    // Manejar las nuevas imágenes
    if ($request->hasFile('imagenes')) {
        // Eliminar imágenes existentes solo si se suben nuevas
        foreach ($producto->imagenes as $imagen) {
            if (file_exists(public_path(ltrim($imagen->ruta, '/')))) {
                unlink(public_path(ltrim($imagen->ruta, '/'))); // Eliminar el archivo físico
            }
            $imagen->delete(); // Eliminar el registro de la base de datos
        }

        // Subir y asociar las nuevas imágenes
        foreach ($request->file('imagenes') as $imagen) {
            $nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
            $ruta = '/img/' . $nombreArchivo;

            // Mover la imagen a public/img
            $imagen->move(public_path('img'), $nombreArchivo);

            // Asociar la nueva imagen al producto
            $producto->imagenes()->create(['ruta' => $ruta]);
        }
    }

    // Redirigir con mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
}



}

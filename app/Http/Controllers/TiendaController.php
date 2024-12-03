<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;

class TiendaController extends Controller
{
    // Método para mostrar la tienda con todos los productos
    public function index()
    {
        $productos = Producto::with('imagenes', 'categoria')->get(); // Relación con categoría
        $categorias = Categoria::all(); // Obtenemos todas las categorías dinámicamente
        return view('tienda', compact('productos', 'categorias'));
    }

    // Método para mostrar un producto detallado por su ID
    public function mostrarProducto($id)
    {
        $producto = Producto::with('imagenes', 'categoria')->findOrFail($id);
        return view('tienda.vistaProducto', compact('producto'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function mostrarCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $productos = Producto::whereIn('id', array_keys($carrito))->get();

        // Añadir cantidades al array de productos
        $productos = $productos->map(function ($producto) use ($carrito) {
            $producto->cantidad = $carrito[$producto->id];
            return $producto;
        });

        return view('tienda.vistaCarrito', compact('productos'));
    }

    public function agregarProducto(Request $request)
    {
        $productoId = $request->input('producto_id');
        $cantidad = (int)$request->input('cantidad', 1);

        $carrito = $request->session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            $carrito[$productoId] += $cantidad;
        } else {
            $carrito[$productoId] = $cantidad;
        }

        $request->session()->put('carrito', $carrito);

        return response()->json(['success' => true, 'totalCount' => array_sum($carrito)]);
    }

    public function procederPago(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $productos = Producto::whereIn('id', array_keys($carrito))->with('imagenes')->get();

        $mensaje = "Hola, este es el resumen de tu pedido:\n\n";
        $costoTotal = 0;

        foreach ($productos as $producto) {
            $cantidad = $carrito[$producto->id];
            $subtotal = $producto->precio * $cantidad;
            $imagen = $producto->imagenes->first() ? asset($producto->imagenes->first()->ruta) : asset('/img/default.jpg'); // Obtener el enlace de la imagen

            $mensaje .= "🔹 *{$producto->nombre}*\n";
            $mensaje .= "   • Imagen: $imagen\n"; // Agregar enlace de la imagen
            $mensaje .= "   • Cantidad: $cantidad\n";
            $mensaje .= "   • Precio unitario: S/ " . number_format($producto->precio, 2) . "\n";
            $mensaje .= "   • Subtotal: S/ " . number_format($subtotal, 2) . "\n\n";

            $costoTotal += $subtotal;
        }

        $mensaje .= "💳 *Costo Total: S/ " . number_format($costoTotal, 2) . "*";

        $whatsappNumber = "51912086668";
        $url = "https://wa.me/{$whatsappNumber}?text=" . urlencode($mensaje);

        return redirect($url);
    }

    public function eliminarProducto(Request $request, $id)
    {
        $carrito = $request->session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            $request->session()->put('carrito', $carrito);
        }

        return response()->json(['success' => true, 'totalCount' => array_sum($carrito)]);
    }

    public function actualizarCantidad(Request $request, $id)
    {
        $cantidad = (int)$request->input('cantidad', 1);
        $carrito = $request->session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id] = $cantidad;
            $request->session()->put('carrito', $carrito);
        }

        return response()->json(['success' => true, 'totalCount' => array_sum($carrito)]);
    }

    public function contarProductos(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        return response()->json(['count' => array_sum($carrito)]);
    }
}

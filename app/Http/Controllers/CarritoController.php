<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function mostrarCarrito()
    {
        $carritoItems = Carrito::with('producto')->get();
        return view('tienda.vistaCarrito', compact('carritoItems'));
    }

    public function agregarProducto(Request $request)
    {
        $carritoItem = Carrito::where('producto_id', $request->producto_id)->first();

        if ($carritoItem) {
            $carritoItem->cantidad += $request->cantidad;
            $carritoItem->save();
        } else {
            Carrito::create([
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad
            ]);
        }

        $totalCount = Carrito::sum('cantidad');
        return response()->json(['success' => true, 'totalCount' => $totalCount]);
    }

    public function procederPago()
    {
        $productos = Carrito::with('producto')->get();
        $mensaje = "Hola, este es el resumen de tu pedido:\n\n";

        $costoTotal = 0;

        foreach ($productos as $item) {
            $nombre = $item->producto->nombre;
            $imagen = $item->producto->imagen; // URL de la imagen
            $cantidad = $item->cantidad;
            $precioUnitario = number_format($item->producto->precio, 2);
            $subtotal = number_format($item->producto->precio * $item->cantidad, 2);

            $mensaje .= "🔹 *$nombre*\n";
            $mensaje .= "   • Imagen: $imagen\n";
            $mensaje .= "   • Cantidad: $cantidad\n";
            $mensaje .= "   • Precio unitario: S/ $precioUnitario\n";
            $mensaje .= "   • Subtotal: S/ $subtotal\n\n";

            $costoTotal += $item->producto->precio * $item->cantidad;
        }

        $mensaje .= "💳 *Costo Total: S/ " . number_format($costoTotal, 2) . "*";

        $whatsappNumber = "51912086668"; // Incluye el prefijo del país
        $url = "https://wa.me/{$whatsappNumber}?text=" . urlencode($mensaje);

        return redirect($url);
    }

    public function eliminarProducto($id)
    {
        $carritoItem = Carrito::findOrFail($id);
        $carritoItem->delete();

        $totalCount = Carrito::sum('cantidad');
        return response()->json(['success' => true, 'totalCount' => $totalCount]);
    }

    public function actualizarCantidad(Request $request, $id)
    {
        $carritoItem = Carrito::findOrFail($id);
        $carritoItem->cantidad = $request->cantidad;
        $carritoItem->save();

        $totalCount = Carrito::sum('cantidad');
        return response()->json(['success' => true, 'totalCount' => $totalCount]);
    }

    public function contarProductos()
    {
        $count = Carrito::sum('cantidad');
        return response()->json(['count' => $count]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;

// Ruta de inicio que carga la vista principal (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// Ruta para la tienda (lista de productos)
Route::get('/Tienda', [TiendaController::class, 'index'])->name('tienda.index');

// Ruta para mostrar un producto en detalle
Route::get('/Producto/{id}', [TiendaController::class, 'mostrarProducto'])->name('producto.detalle');

// Rutas para el carrito
Route::get('/Carrito', [CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/Carrito/agregar', [CarritoController::class, 'agregarProducto'])->name('carrito.agregar');
Route::get('/Carrito/proceder', [CarritoController::class, 'procederPago'])->name('carrito.proceder');
Route::delete('/Carrito/eliminar/{id}', [CarritoController::class, 'eliminarProducto'])->name('carrito.eliminar');
Route::patch('/Carrito/actualizar/{id}', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizar');
Route::get('/Carrito/contar', [CarritoController::class, 'contarProductos'])->name('carrito.contar');

// Ruta para la página Nosotros
Route::get('/Nosotros', function () {
    return view('nosotros');
})->name('nosotros');

// Ruta para la página Contacto
Route::get('/Contacto', function () {
    return view('contacto');
})->name('contacto');

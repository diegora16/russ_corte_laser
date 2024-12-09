<?php

use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

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


//------- RUTAS PARA ADMIN -------

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/panel', function () {
    return view('auth.panel');
})->name('panel')->middleware('auth');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias')->middleware('auth');
Route::post('/categorias', [CategoriaController::class, 'create'])->name('categorias.create')->middleware('auth');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store')->middleware('auth');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('auth');
Route::patch('/categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware('auth');
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('auth');


Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index')->middleware('auth');
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('auth');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('auth');

// Mostrar el formulario para agregar un producto
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create')->middleware('auth');

// Guardar un nuevo producto
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store')->middleware('auth');


// Mostrar el formulario de edición de un producto
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('auth');

// Actualizar un producto existente
Route::patch('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update')->middleware('auth');


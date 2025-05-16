<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('login'); //formulario para login
})->name('login');

//login

Route::post('/logincontroller',[UserController::class,'login'])->name('route.login'); //logica sobre el login

Route::post('/logout', [UserController::class, 'logout'])->name('route.logout'); //cerrar sesion

//

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('inicio'); //pagina principal
    })->name('inicio');    
});

//empelado

Route::post('/formularioempleado', [UserController::class, 'formularioEmpleado'])->name('formulario.empleado');

Route::post('/registrerController', [UserController::class, 'registrarEmpleado'])->name('registro.empleado');

//

//producto

Route::get('/formularioempleado', [ProductController::class, 'formularioProducto'])->name('formulario.producto');

Route::post('/addController', [ProductController::class, 'agregarProducto'])->name('registro.producto');

//


//ventas

    Route::get('/ventas', function () {
        return view('ventas');
    })->name('ventas.inicio');    



Route::get('/buscar-productos', [SaleController::class, 'buscar'])->name('buscar.productos');


Route::post('/ventasregistrar', [SaleController::class, 'registrar'])->name('registro.venta');

// Ruta para buscar productos


Route::get('/productos', [ProductController::class, 'ProductosCategoria'])->name('busqueda.inicio'); //ruta inicial

Route::post('/traer-producto', [ProductController::class, 'buscarProducto']); //busqueda de producto individual

Route::post('/traer-productos', [ProductController::class, 'TraerProductos']); //busqueda de productos por categoria

//


// rutas editar productos


Route::get('/edicionproducto', function () {
        return view('editarProducto');
})->name('formulario.edicion');

Route::get('/edicion/producto', [ProductController::class, 'buscarProductoEdicion']);

Route::patch('/edicion/productoeditado', [ProductController::class, 'edicionProducto']);

Route::delete('/eliminarProducto', [ProductController::class, 'eliminarProducto'])->name('eliminar.producto');


//


// rutas cambio de precio


Route::get('/cambioprecios', [ProductController::class, 'formularioCambiarPrecios'])->name('formulario.precio');

Route::patch('cambioprecios/categoria', [ProductController::class, 'cambiarPrecio'])->name('editar.precio');

//

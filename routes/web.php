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

Route::get('/productos', function () {
    return view('busquedaarticulos');
})->name('busqueda.inicio');  

Route::post('/traer-producto', [ProductController::class, 'buscarProducto']);
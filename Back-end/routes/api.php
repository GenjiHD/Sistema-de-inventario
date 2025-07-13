<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\DelegacionController;
use App\Http\Controllers\ReporteMovimientoController;
use App\Http\Controllers\TipoMovimientoController;
use App\Http\Controllers\UsuarioController;

use App\Http\Middleware\CheckAdministrador;
use App\Http\Middleware\CheckRegistros;


// Rutas para los productos

Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);//->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::put('/productos/{id}', [ProductoController::class, 'update']);//->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);//->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::get('/productos/buscar', [ProductoController::class, 'buscar']);

//Rutas para Municipios

Route::get('/municipios', [MunicipiosController::class, 'index']);

//Rutas para Departamentos

Route::get('/departamentos', [DepartamentosController::class, 'index']);
Route::post('/departamtentos', [DepartamentosController::class, 'store']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::put('/departamentos/{id}', [DepartamentosController::class, 'update']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::delete('/departamentos/{id}', [DepartamentosController::class, 'destroy']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::get('/departamentos/buscar', [DelegacionController::class, 'buscar']);

//Rutas para Delegaciones

Route::get('/delegaciones', [DelegacionController::class, 'index']);

//Rutas para reportes de movimientos

Route::get('/reportes-movimientos', [ReporteMovimientoController::class, 'index']);
Route::post('/reportes-movimientos', [ReporteMovimientoController::class, 'store']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::put('/reportes-movimientos/{id}', [ReporteMovimientoController::class, 'update']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::delete('/reportes-movimientos/{id}', [ReporteMovimientoController::class, 'destroy']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::get('/reportes-movimientos/buscar', [ReporteMovimientoController::class, 'buscar']);

//Rutas para los tipos de movimientos

Route::get('/tipos-movimientos', [TipoMovimientoController::class, 'index']);
Route::post('/tipos-movimientos', [TipoMovimientoController::class, 'store']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::put('/tipos-movimientos/{id}', [TipoMovimientoController::class, 'update']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);
Route::delete('/tipos-movimientos/{id}', [TipoMovimientoController::class, 'destroy']); //->middleware([CheckAdministrador::class, CheckRegistros::class]);

//Rutas para los usuarios

Route::get('/usuarios', [UsuarioController::class, 'index']); //->middleware(CheckAdministrador::class);
Route::post('/usuarios', [UsuarioController::class, 'store']); //->middleware(CheckAdministrador::class);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']); //->middleware(CheckAdministrador::class);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']); //->middleware(CheckAdministrador::class);

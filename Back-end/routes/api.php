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

// Rutas para los productos

Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
Route::put('/productos/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
Route::get('/productos/buscar', [ProductoController::class, 'buscar']);

//Rutas para Municipios

Route::get('/municipios', [MunicipiosController::class, 'index']);

//Rutas para Departamentos

Route::get('/departamentos', [DepartamentosController::class, 'index']);
Route::post('/departamtentos', [DepartamentosController::class, 'store']);
Route::put('/departamentos/{id}', [DepartamentosController::class, 'update']);
Route::delete('/departamentos/{id}', [DepartamentosController::class, 'destroy']);
Route::get('/departamentos/buscar', [DelegacionController::class, 'buscar']);

//Rutas para Delegaciones

Route::get('/delegaciones', [DelegacionController::class, 'index']);

//Rutas para reportes de movimientos

Route::get('/reportes-movimientos', [ReporteMovimientoController::class, 'index']);
Route::post('/reportes-movimientos', [ReporteMovimientoController::class, 'store']);
Route::put('/reportes-movimientos/{id}', [ReporteMovimientoController::class, 'update']);
Route::delete('/reportes-movimientos/{id}', [ReporteMovimientoController::class, 'destroy']);
Route::get('/reportes-movimientos/buscar', [ReporteMovimientoController::class, 'buscar']);

//Rutas para los tipos de movimientos

Route::get('/tipos-movimientos', [TipoMovimientoController::class, 'index']);
Route::post('/tipos-movimientos', [TipoMovimientoController::class, 'store']);
Route::put('/tipos-movimientos/{id}', [TipoMovimientoController::class, 'update']);
Route::delete('/tipos-movimientos/{id}', [TipoMovimientoController::class, 'destroy']);

//Rutas para los usuarios

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

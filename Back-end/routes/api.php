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


//Rutas para Municipios

Route::get('/municipios', [MunicipiosController::class, 'index']);

//Rutas para Departamentos

Route::get('/departamentos', [DepartamentosController::class, 'index']);

//Rutas para Delegaciones

Route::get('/delegaciones', [DelegacionController::class, 'index']);

//Rutas para reportes de movimientos

Route::get('/reportes-movimientos', [ReporteMovimientoController::class, 'index']);

//Rutas para los tipos de movimientos

Route::get('/tipos-movimientos', [TipoMovimientoController::class, 'index']);

//Rutas para los usuarios

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);

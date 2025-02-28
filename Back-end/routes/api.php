<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\DelegacionController;

// Rutas para los productos

Route::get('/productos', [ProductoController::class, 'index']);


//Rutas para Municipios

Route::get('/municipios', [MunicipiosController::class, 'index']);

//Rutas para Departamentos

Route::get('/departamentos', [DepartamentosController::class, 'index']);

//Rutas para Delegaciones

Route::get('/delegaciones', [DelegacionController::class, 'index']);

<?php

use App\Http\Controllers\CalleController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('regiones', RegionController::class);
//Route::apiResource('provincias', ProvinciaController::class);
//Route::apiResource('ciudades', CiudadController::class);
//Route::apiResource('calles', CalleController::class);

Route::resource('regiones', RegionController::class)->parameters(['regiones' => 'region']);
Route::resource('ciudades', CiudadController::class)->parameters(['ciudades' => 'ciudad']);
Route::resource('provincias', ProvinciaController::class)->parameters(['provincias' => 'provincia']);
Route::resource('calles', CalleController::class)->parameters(['calles' => 'calle']);

Route::get('regiones/{id}/provincias', [RegionController::class, 'getProvincias']);
Route::get('provincias/{id}/ciudades', [ProvinciaController::class, 'getCiudades']);
Route::get('ciudades/{id}/calles', [CiudadController::class, 'getCalles']);

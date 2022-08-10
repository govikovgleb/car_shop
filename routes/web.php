<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// маршрут для доступа в каталог
Route::get('/catalog', [\App\Http\Controllers\CarController::class, 'index'])->name('catalog');

// маршрут для фильтрации в какому либо полю(полям)
Route::post('/catalog', [\App\Http\Controllers\CarController::class, 'filter'])->name('filter');

// маршрут для получения товаров с фильтрацией по бренду и/или моделе
Route::get('/catalog/{brand}/{model?}', [\App\Http\Controllers\CarController::class, 'brandFilter'])->name('brand_model_filter');

Route::get('/', function () {
    return view('welcome');
});

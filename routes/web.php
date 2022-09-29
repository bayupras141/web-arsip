<?php

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

Route::get('/', [App\Http\Controllers\SuratController::class, 'index']);
Route::get('/about', [App\Http\Controllers\SuratController::class, 'about']);
Route::get('/unduh/{id}', [App\Http\Controllers\SuratController::class, 'unduh']);
Route::get('/lihat/{id}', [App\Http\Controllers\SuratController::class, 'lihat']);

Route::resource('/surat', App\Http\Controllers\SuratController::class);


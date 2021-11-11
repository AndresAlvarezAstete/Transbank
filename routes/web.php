<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfirmacionController;
use App\Http\Controllers\TablaController;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('confirmacion/{compra_id}', [ConfirmacionController::class, 'confirmation'])->name('confirmacion');
Route::get('/tabla', [TablaController::class, 'index']);
Route::get('/detalle_compra/{id}', [TablaController::class, 'edit']);


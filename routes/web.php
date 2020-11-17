<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KameraController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SewaController;
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

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/detcam', function () {
    return view('kamera.datcam');
});

Route::get('/detcam/{no}', [KameraController::class, 'detcam']);*/
Route::get('', [HomeController::class, 'index']);
Route::resources([
    'home' => HomeController::class,
    'kamera' => KameraController::class,
    'kategori' => KategoriController::class,
    'sewa' => SewaController::class,

]);
<?php

use App\Http\Controllers\Api\KameraController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\SewaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [KameraController::class, 'index']);
Route::resources([
    'kamera' => KameraController::class,
    'kategori' => KategoriController::class,
    'sewa' => SewaController::class,
    
]);
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\Admin;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/produk', [ProdukController::class, 'index']);

//get produk
Route::middleware('auth:sanctum')->group(function(){
    Route::resource('/produk', ProdukController::class)->except('index', 'show')->middleware('admin');
    Route::resource('/order', OrderController::class);
    Route::resource('/diskon', DiskonController::class);
    Route::resource('/keranjang', KeranjangController::class);
}); 
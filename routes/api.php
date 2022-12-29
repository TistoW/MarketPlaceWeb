<?php

use App\Http\Controllers\api\AlamatTokoController;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TokoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('user')->group(function () {
    Route::get('home', [HomeController::class, 'getHome']);

    Route::put('update-user/{id}', [AuthController::class, 'update']);
    Route::post('upload-user/{id}', [AuthController::class, 'upload']);

    Route::resource('toko', TokoController::class);
    Route::get('toko-user/{id}', [TokoController::class, 'cekToko']);

    Route::resource('alamat-toko', AlamatTokoController::class);
    Route::post('upload/product', [ProductController::class, 'upload']);
    Route::resource('product', ProductController::class);
    Route::get('product-detail/{id}', [ProductController::class, 'detailProduct']);

    Route::post('upload/{path}', [BaseController::class, 'upload']);
});

Route::middleware('admin')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('slider', SliderController::class);
});




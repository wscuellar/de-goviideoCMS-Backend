<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandLocation\BrandLocationController;

/*
|--------------------------------------------------------------------------
| Brand API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/brands-locations/{id}', [BrandLocationController::class, 'listBrandLocation'])->name('api.v1.brands-locations');

Route::delete('/brands-locations/{id}', [BrandLocationController::class, 'destroyBrandLocation'])->name('api.v1.destroybrands-locations');

Route::post('/create-brands-locations', [BrandLocationController::class, 'storeBrandLocation']);

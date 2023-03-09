<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Brand\BrandController;

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

Route::apiResource('brands', BrandController::class)->names('api.v1.brands');
Route::post('brand-update/{id}', [BrandController::class,'updateBrand'])->name('api.v1.brand-update');
Route::get('brand-list/{id}', [BrandController::class,'listBrand'])->name('api.v1.brand-list');

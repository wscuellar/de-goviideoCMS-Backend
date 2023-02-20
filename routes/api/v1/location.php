<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Location\LocationController;
/*
|--------------------------------------------------------------------------
| Location API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('locations', LocationController::class)->names('api.v1.locations');
Route::post('location-update/{id}', [LocationController::class,'updateLocation'])->name('api.v1.location-update');
Route::get('location-list/{id}', [LocationController::class,'listLocation'])->name('api.v1.location-list');

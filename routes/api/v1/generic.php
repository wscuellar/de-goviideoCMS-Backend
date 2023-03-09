<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenericController;

//use App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| Generic API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Ping for 503
Route::get('/ping', [GenericController::class ,'ping503']);
Route::get('/timezone', [GenericController::class ,'timezone']);
Route::get('/countries', [GenericController::class ,'countries']);
Route::get('/states/{country_id}', [GenericController::class ,'states']);
Route::get('/cities/{state_id}', [GenericController::class ,'cities']);

Route::get('/tokenpasswordreset', [GenericController::class ,'tokenPasswordReset'])->middleware('auth:sanctum');
Route::post('/validatedck', [GenericController::class ,'validateCreditCard']);

//Route::post('/register', [RegisterController::class ,'register']);





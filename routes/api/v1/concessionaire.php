<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Concessionaire\ConcessionaireController;

/*
|--------------------------------------------------------------------------
| Concessionaire API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('concessionaires', ConcessionaireController::class)->names('api.v1.concessionaires');
Route::post('concessionaire-update/{id}', [ConcessionaireController::class,'updateConcessionaire'])->name('api.v1.concessionaire-update');
Route::get('concessionaire-list/{id}', [ConcessionaireController::class,'listConcessionaire'])->name('api.v1.concessionaire-list');

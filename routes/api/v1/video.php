<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Hihaho\HihahoController;

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

Route::get('video-list', [HihahoController::class,'getAllVideos'])->name('api.v1.video-list');
Route::get('video-statistics/{id}', [HihahoController::class,'statisticsVideo'])->name('api.v1.video-list');
Route::post('assign-video-client/{id}', [HihahoController::class,'statisticsVideo'])->name('api.v1.video-list');

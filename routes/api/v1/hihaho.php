<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Hihaho\HihahoController;
use App\Http\Controllers\Api\Hihaho\VideoController;

/*
|--------------------------------------------------------------------------
| Hihaho API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('video-hihaho-info/{videoId}', [HihahoController::class,'hihahoVideoToClient'])->name('api.v1.video-hihaho-info');
Route::get('video-hihaho-statistics/{videoId}', [HihahoController::class,'hihahoVideoToClientStatistics'])->name('api.v1.video-hihaho-info-Statistics');
Route::get('video-hihaho-all', [VideoController::class,'getAllVideos'])->name('api.v1.video-hihaho-all');
Route::get('videos', [VideoController::class,'getVideosGeneral'])->name('api.v1.videos');
Route::get('assigned-videos', [VideoController::class,'getAllVideosAsignados'])->name('api.v1.assigned-videos');
Route::get('video-store/{id}', [VideoController::class,'VideoToStore'])->name('api.v1.video-store-list');
Route::post('video-store/{id}', [VideoController::class,'addVideoToStore'])->name('api.v1.video-store-add');
Route::post('video-location/{id}', [VideoController::class,'addVideoToLocation'])->name('api.v1.video-location-add');
Route::post('video-brand/{id}', [VideoController::class,'addVideoToBrand'])->name('api.v1.video-brand-add');

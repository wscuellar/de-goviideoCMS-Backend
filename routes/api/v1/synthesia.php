<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Synthesia\SynthesiaController;
use App\Http\Controllers\Api\Synthesia\SynthesiaVideoController;

/*
|--------------------------------------------------------------------------
| Synthesia API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::get('video-hihaho-info/{videoId}', [HihahoController::class,'hihahoVideoToClient'])->name('api.v1.video-hihaho-info');
Route::get('video-hihaho-statistics/{videoId}', [HihahoController::class,'hihahoVideoToClientStatistics'])->name('api.v1.video-hihaho-info-Statistics');
Route::get('video-hihaho-all', [VideoController::class,'getAllVideos'])->name('api.v1.video-hihaho-all');
Route::get('videos', [VideoController::class,'getVideosGeneral'])->name('api.v1.videos');
Route::get('assigned-videos', [VideoController::class,'getAllVideosAsignados'])->name('api.v1.assigned-videos');
Route::get('video-store/{id}', [VideoController::class,'VideoToStore'])->name('api.v1.video-store-list');
Route::post('video-store/{id}', [VideoController::class,'addVideoToStore'])->name('api.v1.video-store-add');
Route::post('video-location/{id}', [VideoController::class,'addVideoToLocation'])->name('api.v1.video-location-add');
Route::post('video-brand/{id}', [VideoController::class,'addVideoToBrand'])->name('api.v1.video-brand-add');
*/

Route::get('synthesia/videos', [SynthesiaVideoController::class,'index'])->name('api.v1.synthesia-videos');
Route::get('synthesia/videos-store/{id}', [SynthesiaVideoController::class,'listVideo'])->name('api.v1.synthesia-video-store');
Route::get('synthesia/videos/{id}', [SynthesiaVideoController::class,'show'])->name('api.v1.synthesia-video-show');
Route::get('synthesia/video-status/{id}', [SynthesiaVideoController::class,'status'])->name('api.v1.synthesia-video-show');
Route::post('synthesia/videos', [SynthesiaVideoController::class,'store'])->name('api.v1.synthesia-video-create');
Route::delete('synthesia/videos/{id}', [SynthesiaVideoController::class,'destroy'])->name('api.v1.synthesia-video-destroy');
Route::patch('synthesia/videos/{id}', [SynthesiaVideoController::class,'update'])->name('api.v1.synthesia-video-destroy');

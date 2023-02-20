<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Synthesia\AssetController;

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


Route::get('avatars', [AssetController::class,'getAvatar'])->name('api.v1.avatar');
Route::get('avatar-background', [AssetController::class,'getBackgrounds'])->name('api.v1.avatar-background');
Route::get('avatar-voice', [AssetController::class,'getVoices'])->name('api.v1.avatar-background');
Route::get('avatar-soundtrack', [AssetController::class,'getSoundTrack'])->name('api.v1.avatar-background');


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfilePhotoController;

/*
|--------------------------------------------------------------------------
| USER Resource API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::apiResource('users', UserController::class)->names('api.v1.users');

Route::get('/list-users', [UserController::class, 'listUsers'])->name('api.v1.user-list');
Route::post('/user/profile-photo/{user}', [ProfilePhotoController::class, 'uploadPhoto'])->name('api.v1.profile-photo');
Route::post('/user/delete-profile-photo/{user_id}', [ProfilePhotoController::class, 'deletePhoto'])->name('api.v1.profile-photo');

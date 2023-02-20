<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\PasswordResetController;

/*
|--------------------------------------------------------------------------
| AUTH API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", [AuthenticationController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::post("/logout", [AuthenticationController::class, "logout"]);
    Route::get("users/auth", [AuthenticationController::class, "user"]);
});

Route::post('/forgot-password',[PasswordResetController::class,'email'])->name('password.forgot');
Route::get('/password/find/{token}',[PasswordResetController::class,'find'])->name('password.find');
Route::post('/password/reset', [PasswordResetController::class,'reset'])->name('password.reset');
Route::post('/update-password/{user}', [PasswordResetController::class,'updatePassword'])->name('update.password');

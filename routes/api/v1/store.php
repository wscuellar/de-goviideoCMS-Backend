<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Store\StoreController;
use App\Http\Controllers\Api\Store\UserStoreController;

/*
|--------------------------------------------------------------------------
| Store API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

   Route::apiResource('stores', StoreController::class)->names('api.v1.stores');
   Route::get('store/info/{id}', [StoreController::class, 'info'])->name('store.info');
   Route::post('store-update/{id}', [StoreController::class,'updateStore'])->name('api.v1.store-update');


   // USER FOR STORE
   Route::get('/store-users/{store_id}', [UserStoreController::class ,'index']);
   Route::get('/store-user-show/{id}', [UserStoreController::class ,'show']);
   Route::post('/store-create-user/{store_id}', [UserStoreController::class ,'store']);
   Route::post('/store-updated-user/{id}', [UserStoreController::class ,'updated']);
   Route::delete('/store-delete-user/{id}', [UserStoreController::class ,'destroy']);



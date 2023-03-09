<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("v1")->group(function ()
{
    require base_path('routes/api/v1/auth.php');
    require base_path('routes/api/v1/generic.php');

    Route::middleware('auth:sanctum')->group(function ()
    {
        require base_path('routes/api/v1/store.php');
        require base_path('routes/api/v1/brand.php');
        require base_path('routes/api/v1/location.php');
        require base_path('routes/api/v1/concessionaire.php');
        require base_path('routes/api/v1/brandlocation.php');
        require base_path('routes/api/v1/video.php');
        require base_path('routes/api/v1/hihaho.php');
        require base_path('routes/api/v1/synthesia.php');
        require base_path('routes/api/v1/asset.php');
        require base_path('routes/api/v1/users.php');
    });

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\PrestataireController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\GalerieController;
use Illuminate\Support\Facades\Crypt;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/token/{authorization}', function (Request $request, $authorization) {
    $decrypt = Crypt::decrypt($authorization);
    $id = explode('<>', $decrypt)[0];
    $prefix = explode('<>', $decrypt)[1];

    if($prefix == 'pid') {
        return PrestataireController::find($id);
    }

    if($prefix == 'uid') {
        return UserController::find($id);
    }
    
});

Route::prefix('/user')->group(function () {
    Route::post('/create', [userController::class, 'create']);
    Route::post('/select', [userController::class, 'select']);
});

Route::prefix('/prestataire')->group(function () {
    Route::post('/create', [PrestataireController::class, 'create']);
    Route::post('/select', [PrestataireController::class, 'select']);
});

Route::prefix('/activity')->group(function () {
    Route::post('/create', [ActiviteController::class, 'create']);
    Route::post('/select', [ActiviteController::class, 'select']);
});

Route::post('/upload-image', [ImageUploadController::class, 'upload']);
Route::post('/galery', [GalerieController::class, 'create']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\PrestataireController;
use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\ActiviteNoteController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\MessageFirstController;
use App\Http\Controllers\MessageSecondController;
use App\Http\Controllers\NotificationPrestataireController;
use App\Http\Controllers\NotificationUserController;
use App\Http\Controllers\ReservationController;
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
    Route::get('/find/{id}', [userController::class, 'find']);
    Route::get('/list', [userController::class, 'all']);

    Route::prefix('/notification')->group(function () {
        Route::get('/count/{authorization}', [NotificationUserController::class, 'count']);
        Route::get('/select/{authorization}', [NotificationUserController::class, 'select']);
    });
});


Route::prefix('/prestataire')->group(function () {
    Route::post('/create', [PrestataireController::class, 'create']);
    Route::post('/select', [PrestataireController::class, 'select']);
    Route::get('/profil/{id}', [PrestataireController::class, 'find']);

    Route::prefix('/notification')->group(function () {
        Route::get('/count/{authorization}', [NotificationPrestataireController::class, 'count']);
        Route::get('/select/{authorization}', [NotificationPrestataireController::class, 'select']);
    });
});

Route::prefix('/activity')->group(function () {
    Route::post('/create', [ActiviteController::class, 'create']);
    Route::get('/select', [ActiviteController::class, 'select']);
    Route::get('/random', [ActiviteController::class, 'random']);
    Route::get('/random-2', [ActiviteController::class, 'random']);
    Route::get('/profil/1/random', [ActiviteController::class, 'profil_random']);
    Route::get('/profil/{id}', [ActiviteController::class, 'profil']);
    Route::get('/fetch/{authorization}', [ActiviteController::class, 'fetch']);
    Route::get('/reservation/{id}', [ReservationController::class, 'get_reservation']);


    Route::prefix('/note')->group(function () {
        Route::post('/create', [ActiviteNoteController::class, 'create']);
        Route::post('/select', [ActiviteNoteController::class, 'select']);
        Route::post('/remove', [ActiviteNoteController::class, 'delete']);
        Route::get('/count/{id_activity}', [ActiviteNoteController::class, 'count']);
    });

});

Route::prefix('/avis')->group(function () {
    Route::post('/create', [AvisController::class, 'create']);
    Route::post('/select', [AvisController::class, 'select']);
});

// Route::prefix('/avisnote')->group(function () {
//     Route::post('/create', [ActiviteNoteController::class, 'create']);
//     Route::post('/select', [ActiviteNoteController::class, 'select']);
// });

Route::post('/upload-image', [ImageUploadController::class, 'upload']);
Route::prefix('/galery')->group(function () {
    Route::post('/', [GalerieController::class, 'create']);
    Route::get('/{id_activity}', [GalerieController::class, 'get_one']);
    Route::get('/photos/{id_activity}', [GalerieController::class, 'get_all']);
});

Route::prefix('/message')->group(function () {
    Route::get('/get/{id}', [MessageSecondController::class, 'select']);
    Route::post('/send', [MessageSecondController::class, 'create']);
    Route::post('/get', [MessageFirstController::class, 'select']);
});

Route::prefix('/reservation')->group(function () {
    Route::post('/new', [ReservationController::class, 'new']);
    Route::post('/accept', [ReservationController::class, 'update']);
    Route::post('/delete', [ReservationController::class, 'destroy']);
    Route::get('/fetch/{authorization}', [ReservationController::class, 'select']);
});
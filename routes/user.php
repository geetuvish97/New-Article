<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ArticalController;
use App\Http\Controllers\EncryptionController;
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

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);

Route::group(['prefix' => '/', 'middleware' => ['user.auth']], function () {
    Route::get('/logout', [UserAuthController::class, 'logout']);
    /** User artical routes*/
    Route::group(['prefix' => '/artical'], function () {
        Route::post('/create', [ArticalController::class, 'create']);
        Route::get('/{id}', [ArticalController::class, 'articalDetailsById']);
        Route::post('/update/{id}', [ArticalController::class, 'update']);
        Route::delete('/delete/{id}', [ArticalController::class, 'delete']);
        Route::post('/list', [ArticalController::class, 'list']);
    });

});

Route::middleware('user.auth')->group(function () {
    Route::post('/encrypt', [EncryptionController::class, 'encrypt']);
    Route::post('/decrypt', [EncryptionController::class, 'decrypt']);
});

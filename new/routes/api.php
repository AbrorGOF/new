<?php

use App\Http\Controllers\PassportController;
use App\Http\Controllers\UserController;
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
Route::post('login', [PassportController::class, 'login']);
Route::post('refresh/token', [PassportController::class, 'refreshToken']);
Route::post('/register', [UserController::class, 'AuthReg']);
Route::post('/check/nurse', [UserController::class, 'ConnectPinfl']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [PassportController::class, 'logout']);
    Route::get('check/user/tokens', [PassportController::class, 'checkUserTokens']);
    Route::get('detail', [PassportController::class, 'detail']);
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\ReportController;
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
Route::post('/register', [UserController::class, 'register']);
Route::post('/check/nurse', [UserController::class, 'ConnectPinfl']);
Route::get('/regions', [UserController::class, 'getRegions']);
Route::get('/categories', [UserController::class, 'getCategories']);
Route::post('/get/info', [AdminController::class, 'getInfo']);
Route::get('/training/centers', [UserController::class, 'getTrainingCenters']);
Route::get('/colleges', [UserController::class, 'getColleges']);
Route::get('/polyclinics', [UserController::class, 'getPolyclinics']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [PassportController::class, 'logout']);
    Route::get('check/user/tokens', [PassportController::class, 'checkUserTokens']);
    Route::get('detail', [PassportController::class, 'detail']);
  Route::get('/patients', [ReportController::class, 'getPatients']);
  Route::post('/patient/add', [ReportController::class, 'createPatient']);
});
Route::post('/test', [AdminController::class, 'index']);

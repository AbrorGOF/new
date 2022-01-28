<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Nurse\NurseController;
use App\Http\Controllers\Report\JournalController;
use App\Http\Controllers\Report\QuarterlyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::route('home');
    } else {
        return redirect("login");
    }
})->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/report/journal', [JournalController::class, 'index'])->name('report-journal');
    Route::post('/report/journal/add', [JournalController::class, 'create'])->name('report-journal-add');
    Route::get('/report/quarterly', [QuarterlyController::class, 'viewPdf'])->name('report-quarterly');
    Route::get('/report/quarterly/pdf', [QuarterlyController::class, 'viewPdf'])->name('report-quarterly-pdf');
    Route::get('/nurse/list', [NurseController::class, 'list'])->name('nurse-list');
});
Route::post('/get/nurse/info', [LoginController::class, 'ConnectPinfl'])->name('get-nurse-info');
Route::post('/auth/reg', [LoginController::class, 'AuthReg'])->name('auth-reg');
Route::get('/select/options', [LoginController::class, 'SelectOptions'])->name('get-select-options');

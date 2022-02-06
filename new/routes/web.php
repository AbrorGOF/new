<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Nurse\NurseController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Report\JournalController;
use App\Http\Controllers\Report\QuarterlyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::route('home');
    } else {
        return Redirect::route('welcome');
    }
});
Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');

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
Route::post('/auth/log', [LoginController::class, 'AuthLog'])->name('auth-log');
Route::get('/select/options', [LoginController::class, 'SelectOptions'])->name('get-select-options');
Route::get('/pdf/new', [PdfController::class, 'new'])->name('new-pdf');
Route::get('/pdf/reference/download', [PdfController::class, 'downloadReference'])->name('reference-pdf-download');
Route::get('/pdf/reference/view', [PdfController::class, 'viewReference'])->name('reference-pdf-view');

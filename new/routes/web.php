<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Nurse\NurseController;
use App\Http\Controllers\NurseController as Nurse;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Report\JournalController;
use App\Http\Controllers\Report\QuarterlyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkerController;
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
Route::get('/auth/register', [RegisterController::class, 'index'])->name('index');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/report/journal', [JournalController::class, 'index'])->name('report-journal');
    Route::post('/report/journal/add', [JournalController::class, 'create'])->name('report-journal-add');
    Route::get('/report/quarterly', [QuarterlyController::class, 'viewPdf'])->name('report-quarterly');
    Route::get('/report/quarterly/pdf', [QuarterlyController::class, 'viewPdf'])->name('report-quarterly-pdf');
    Route::get('/nurse/list', [NurseController::class, 'list'])->name('nurse-list');
    //    ADMIN  //

        Route::get('/admin/polyclinic', [AdminController::class, 'PolyclinicIndex'])->name('polyclinic-index');
        Route::get('/admin/polyclinic/list', [AdminController::class, 'PolyclinicList'])->name('polyclinic-list');
        Route::post('/admin/polyclinic/add', [AdminController::class, 'PolyclinicAdd'])->name('polyclinic-add');
        Route::get('/admin/training/center', [AdminController::class, 'TrainingCenterIndex'])->name('admin-training-center-index');
        Route::get('/admin/training/center/list', [AdminController::class, 'TrainingCenterList'])->name('admin-training-center-list');
        Route::post('/admin/training/center/add', [AdminController::class, 'TrainingCenterAdd'])->name('admin-training-center-add');
    //    ADMIN  //
    //    worker  //
        Route::get('/worker', [WorkerController::class, 'index'])->name('worker-index');
        Route::get('/worker/list', [WorkerController::class, 'WorkerList'])->name('worker-list');
        Route::post('/worker/add', [WorkerController::class, 'WorkerAdd'])->name('worker-add');
    //    worker  //
    //    worker  //
        Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor-index');
        Route::get('/doctor/list', [DoctorController::class, 'DoctorList'])->name('doctor-list');
        Route::post('/doctor/add', [DoctorController::class, 'DoctorAdd'])->name('doctor-add');
    //    worker  //
    //    worker  //
        Route::get('/nurse', [Nurse::class, 'index'])->name('nurse-index');
        Route::get('/nurse/list', [Nurse::class, 'NurseList'])->name('nurse-list');
        Route::post('/nurse/add', [Nurse::class, 'NurseAdd'])->name('nurse-add');
        Route::get('/nurse/show/{id}', [Nurse::class, 'view'])->name('nurse-view');
        Route::post('/nurse/cancel/{id}', [Nurse::class, 'cancel'])->name('nurse-cancel');
        Route::get('/nurse/accept/{id}', [Nurse::class, 'accept'])->name('nurse-accept');
    //    worker  //
});
Route::post('/get/nurse/info', [LoginController::class, 'ConnectPinfl'])->name('get-nurse-info');
Route::post('/auth/reg', [LoginController::class, 'AuthReg'])->name('auth-reg');
Route::post('/auth/log', [LoginController::class, 'AuthLog'])->name('auth-log');
Route::get('/select/options', [LoginController::class, 'SelectOptions'])->name('get-select-options');
Route::get('/pdf/reference/create', [PdfController::class, 'createReference'])->name('create-reference-pdf');
Route::get('/pdf/reference/download', [PdfController::class, 'downloadReference'])->name('reference-pdf-download');
Route::get('/pdf/reference/view', [PdfController::class, 'viewReference'])->name('reference-pdf-view');
Route::get('/test', function () {
  return createReference(1);
});
Route::post('/admin/get/info', [AdminController::class, 'getInfo'])->name('admin-get-info');

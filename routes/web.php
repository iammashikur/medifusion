<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\TestCategoryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestSubCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [AdminController::class, 'index']);
    Route::resource('doctor', DoctorController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('hospital', HospitalController::class);
    Route::resource('test', TestController::class);
    Route::resource('test-category', TestCategoryController::class);
    Route::resource('test-subcategory', TestSubCategoryController::class);

});




Auth::routes();
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::get('/register', [AdminController::class, 'register'])->name('register');



<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NilaiController;
use App\Models\Nilai;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(IndexController::class)->group(function()
{

    Route::get('/','index');
    Route::post('/login-walas', 'loginWalas');
    Route::post('/login-siswa', 'loginSiswa');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware('CheckUserRole:Siswa')->group(function(){
    Route::controller(NilaiController::class)->prefix('nilai-raport')->group(function(){
        Route::get('/show', 'show')->name('muridShow');
    });
});

Route::middleware('CheckUserRole:Walas')->group(function() {
    Route::controller(NilaiController::class)->prefix('nilai-raport')->group(function() {
        Route::get('/index', 'index')->name('guruShow');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/edit/{nilai}', 'edit');
        Route::put('/update/{nilai}', 'update')->name('update');
        Route::get('/destroy/{nilai}', 'destroy');
        Route::get('/show/{id}', 'showNilai');
    });
});

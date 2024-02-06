<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Prefix untuk /master
Route::prefix('master')->group(function () {

    //
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/stok', [App\Http\Controllers\StokController::class, 'index'])->name('get.stok');
        Route::get('/stok/tambah', [App\Http\Controllers\StokController::class, 'tambah'])->name('get.tambah.stok');
        Route::post('/stok/tambah/proses', [App\Http\Controllers\StokController::class, 'proses_tambah'])->name('post.proses-tambah.stok');
        Route::get('/stok/detail/{id}', [App\Http\Controllers\StokController::class, 'detail'])->name('get.detail.stok');
        Route::get('/stok/ubah/{id}', [App\Http\Controllers\StokController::class, 'ubah'])->name('get.ubah.stok');
        Route::patch('/stok/ubah/proses/{id}', [App\Http\Controllers\StokController::class, 'proses_ubah'])->name('post.proses-ubah.stok');
        Route::delete('/stok/hapus/{id}', [App\Http\Controllers\StokController::class, 'hapus'])->name('delete.stok');
    });


    //
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('get.admin');
        Route::get('/admin/tambah', [App\Http\Controllers\AdminController::class, 'tambah'])->name('get.tambah.admin');
        Route::post('/admin/tambah/proses', [App\Http\Controllers\AdminController::class, 'proses_tambah'])->name('post.proses-tambah.admin');
        Route::get('/admin/detail/{id}', [App\Http\Controllers\AdminController::class, 'detail'])->name('get.detail.admin');
        Route::get('/admin/ubah/{id}', [App\Http\Controllers\AdminController::class, 'ubah'])->name('get.ubah.admin');
        Route::patch('/admin/ubah/proses/{id}', [App\Http\Controllers\AdminController::class, 'proses_ubah'])->name('post.proses-ubah.admin');
        Route::delete('/admin/hapus/{id}', [App\Http\Controllers\AdminController::class, 'hapus'])->name('delete.admin');
    });


});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

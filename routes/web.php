<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\penagihancontroller;
use Illuminate\Routing\RouteGroup;
use App\Http\controllers\authcontroller;
use App\Http\controllers\usercontroller;
use App\Http\controllers\pesancontroller;

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


//Auth::routes();

route::get('admin/login', [authcontroller::class, 'login'])->name('login');
route::post('admin/login/proses', [authcontroller::class, 'proses']); 
route::post('admin/logout', [authcontroller::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //crud penagihan
    route::get('admin/penagihan/', [penagihancontroller::class, 'index']);
    route::post('admin/penagihan/store', [penagihancontroller::class, 'store'])->middleware('ketuabagian');
    route::post('admin/penagihan/update', [penagihancontroller::class, 'update'])->middleware('ketuabagian');
    route::get('admin/penagihan/delete/{id}', [penagihancontroller::class, 'destroy'])->middleware('ketuabagian');
    route::get('admin/penagihan/printlist', [penagihancontroller::class, 'printlist'])->middleware('ketuabagian');

    //laporan
    route::get('admin/penagihan/laporan', [penagihancontroller::class, 'laporan']);
    route::get('admin/penagihan/print', [penagihancontroller::class, 'print'])->middleware('ketuabagian');

    //ganti user   
    route::get('admin/user/profile/{id}', [usercontroller::class, 'profile']);
    route::post('admin/user/profile/{id}', [usercontroller::class, 'profileupdate']);

    // pesan
    route::get('pesan', [pesancontroller::class, 'index']);
    route::get('pesan/{id}', [pesancontroller::class, 'pesan']);
    route::post('pesan/{id}', [pesancontroller::class, 'pesan_aksi']);
    route::get('pesan-hapus/{id}', [pesancontroller::class, 'pesan_hapus']);
});

Route::middleware(['auth', 'admin'])->group(function () {
        //crud User
        route::get('admin/user/', [usercontroller::class, 'index']);
        route::get('admin/user/create', [usercontroller::class, 'create']);
        route::post('admin/user/store', [usercontroller::class, 'store']);
        route::get('admin/user/edit/{id}', [usercontroller::class, 'edit']);
        route::post('admin/user/update/{id}', [usercontroller::class, 'update']);
        route::get('admin/user/delete/{id}', [usercontroller::class, 'destroy']);
});
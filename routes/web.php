<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangUserController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KonfirmasiAmbilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'indexLogin'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postLogin'])->name('post_login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

Route::group(['middleware' => ['auth', 'cekStatus:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard_admin'])->name('dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/cabang_list', [CabangController::class, 'index'])->name('cabang.list');
    Route::get('/cabang/create', [CabangController::class, 'create'])->name('cabang.create');
    Route::post('/cabang/store', [CabangController::class, 'store'])->name('cabang.store');
    Route::get('/cabang/edit/{id}', [CabangController::class, 'edit'])->name('cabang.edit');
    Route::put('/cabang/update/{id}', [CabangController::class, 'update'])->name('cabang.update');
    Route::get('/cabang/delete{id}', [CabangController::class, 'destroy'])->name('cabang.destroy');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('/barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/list-peminjaman', [PeminjamanController::class, 'listPeminjaman'])->name('list.peminjaman.admin');
    Route::get('/konfirmasi-pengambilan', [KonfirmasiAmbilController::class, 'konfirmasiAmbil'])->name('konfirmasi_ambil.admin');
    Route::put('/konfirmasi-pengambilan/{id}/update-status', [KonfirmasiAmbilController::class, 'updateStatusKonfirmasiAmbil'])->name('update_status.konfirmasi_ambil');
});


Route::group(['middleware' => ['auth', 'cekStatus:user']], function () {
    Route::get('/dashboard_user', [DashboardController::class, 'dashboard_user'])->name('dashboard.user');
    Route::get('/barang-user', [BarangUserController::class, 'index'])->name('barang_user');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/history', [PeminjamanController::class, 'history'])->name('peminjaman.history');
    Route::get('/peminjaman/cetak-pdf/{id}', [PeminjamanController::class, 'cetak_pdf'])->name('cetak.pdf');
});


Route::group(['middleware' => ['auth', 'cekStatus:manager,hq']], function () {
    Route::get('/list-barang', [BarangController::class, 'list'])->name('barang.list');
});


Route::group(['middleware' => ['auth', 'cekStatus:manager']], function () {
    Route::get('/dashboard_manager', [DashboardController::class, 'dashboard_manager'])->name('dashboard.manager');
    Route::get('/peminjaman/approval_manager', [PeminjamanController::class, 'approval_manager'])->name('peminjaman.approval_manager');
    Route::put('/peminjaman/{id}/update-status-manager', [PeminjamanController::class, 'updateStatusManager'])->name('update_status_manager');
    Route::get('/cabang/versiManager', [UserController::class, 'cabang_versi_manager'])->name('cabang.versi_manager');
});


Route::group(['middleware' => ['auth', 'cekStatus:hq']], function () {
    Route::get('/dashboard_hq', [DashboardController::class, 'dashboard_hq'])->name('dashboard.hq');
    Route::get('/peminjaman/approval_hq', [PeminjamanController::class, 'approval_hq'])->name('peminjaman.approval_hq');
    Route::put('/peminjaman/{id}/update-status-hq', [PeminjamanController::class, 'updateStatusHq'])->name('update_status_hq');
    Route::get('/manager_cabang', [UserController::class, 'manager_cabang'])->name('manager_cabang');
    Route::get('/cabang/versiHq', [UserController::class, 'cabang_versi_hq'])->name('cabang.versi_hq');

});

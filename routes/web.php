<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [AuthController::class,'auth'])->name('/');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');


Route::get('/user', [UserController::class, 'user'])->name('user');
Route::get('/tambah-user', [UserController::class, 'tambahUser'])->name('tambah-user');
Route::post('/tambah-user', [UserController::class, 'simpanUser'])->name('simpan-user');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
Route::get('/hapus/{id}', [UserController::class, 'hapus'])->name('hapus');



Route::get('/produk', [ProdukController::class, 'produk'])->name('produk');
Route::get('/tambah-produk', [ProdukController::class, 'tambahProduk'])->name('tambah-produk');
Route::post('/tambah-produk', [ProdukController::class, 'simpanProduk'])->name('simpanProduk');
Route::get('/edit-produk/{id}', [ProdukController::class, 'editProduk'])->name('edit-produk');
Route::patch('/edit-produk/{id}', [ProdukController::class, 'updateProduk'])->name('update-produk');
Route::get('/hapus-produk/{id}', [ProdukController::class, 'hapusProduk'])->name('hapus-produk');


Route::get('/penjualan', [PenjualanController::class, 'penjualan'])->name('penjualan');
Route::get('/tambah-penjualan', [penjualanController::class, 'tambahPenjualan'])->name('tambah-penjualan');
Route::post('/tambah-penjualan', [penjualanController::class, 'simpanPenjualan'])->name('simpan-penjualan');
Route::get('sale/detail/{id}', [PenjualanController::class, 'detailSale'])->name('sale.detail');
// Route::get('/staff/view/pdf', [PenjualanController::class, 'view_pdf']);


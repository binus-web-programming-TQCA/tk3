<?php

use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Models\Transaksi;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/staff', function () {
//     return view('staff');
// })->middleware(['auth', 'verified'])->name('staff');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/staff', [StaffController::class, 'edit'])->name('staff.edit');
//     Route::patch('/staff', [StaffController::class, 'update'])->name('staff.update');
//     Route::delete('/staff', [StaffController::class, 'destroy'])->name('staff.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create/{id}', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/list-transaksi', [TransaksiController::class, 'list_order'])->name('transaksi.list_order');
    Route::get('/list-transaksi/submit/{id}', [TransaksiController::class, 'submit'])->name('transaksi.submit');

});
Route::middleware(['auth', 'role:staff,admin'])->group(function () {
    Route::get('/pembeli', [PembeliController::class, 'list'])->name('pembeli.list');
    Route::get('/pembeli/add', [PembeliController::class, 'add'])->name('pembeli.add');
    Route::get('/pembeli/edit/{id}', [PembeliController::class, 'edit'])->name('pembeli.edit');
    Route::post('/pembeli/update/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
    Route::get('/pembeli/delete/{id}', [PembeliController::class, 'delete'])->name('pembeli.delete');
    Route::get('/pembeli/{id}', [PembeliController::class, 'view'])->name('pembeli.view');
    Route::post('/pembeli', [PembeliController::class, 'store'])->name('pembeli.store');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staffs.create');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staffs.edit');
    Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('staffs.update');
    Route::get('/staff/destroy/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');
    // Route::get('/staff/{id}', [StaffControllerController::class, 'view'])->name('staffs.view');
    Route::post('/staff', [StaffController::class, 'store'])->name('staffs.store');
});

Route::middleware(['auth','role:staff,admin'])->group(function () {
    Route::get('/data-barang', [DataBarangController::class, 'index'])->name('barang.index');
    Route::get('/data-barang/create', [DataBarangController::class, 'create'])->name('barang.create');
    Route::get('/data-barang/edit/{id}', [DataBarangController::class, 'edit'])->name('barang.edit');
    Route::post('/data-barang/update/{id}', [DataBarangController::class, 'update'])->name('barang.update');
    Route::get('/data-barang/destroy/{id}', [DataBarangController::class, 'destroy'])->name('barang.destroy');
    // Route::get('/data-barang/{id}', [StaffControllerController::class, 'view'])->name('staffs.view');
    Route::post('/data-barang', [DataBarangController::class, 'store'])->name('barang.store');
});
require __DIR__.'/auth.php';

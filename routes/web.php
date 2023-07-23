<?php

use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/pembeli', [PembeliController::class, 'list'])->name('pembeli.list');
    Route::get('/pembeli/add', [PembeliController::class, 'add'])->name('pembeli.add');
    Route::get('/pembeli/delete/{id}', [PembeliController::class, 'delete'])->name('pembeli.delete');
    Route::get('/pembeli/{id}', [PembeliController::class, 'view'])->name('pembeli.view');
    Route::post('/pembeli', [PembeliController::class, 'store'])->name('pembeli.store');
});

Route::middleware(['auth', 'role:staf'])->group(function () {
    // Rute untuk pengguna dengan peran "staf"
});

Route::middleware(['auth', 'role:pembeli'])->group(function () {
    // Rute untuk pengguna dengan peran "pembeli"
});
require __DIR__.'/auth.php';

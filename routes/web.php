<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
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
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Rute untuk pengguna dengan peran "admin"
});

Route::middleware(['auth'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staffs.create');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staffs.edit');
    Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('staffs.update');
    Route::get('/staff/destroy/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');
    // Route::get('/staff/{id}', [StaffControllerController::class, 'view'])->name('staffs.view');
    Route::post('/staff', [StaffController::class, 'store'])->name('staffs.store');
});

Route::middleware(['auth', 'role:pembeli'])->group(function () {
    // Rute untuk pengguna dengan peran "pembeli"
});
require __DIR__.'/auth.php';

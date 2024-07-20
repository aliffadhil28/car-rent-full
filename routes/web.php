<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;
use App\Http\Controllers\LogsController;

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
    return view('welcome');
});

Route::get('/dashboard', [RentController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rent
    Route::post('/rent', [RentController::class, 'store'])->name('rents.store');
    Route::get('/rent', [RentController::class, 'index'])->name('rents.index');
    Route::post('/rent-update', [RentController::class, 'update'])->name('rents.update');
    Route::get('/rent/{id}', [RentController::class, 'edit'])->name('rents.edit');
    Route::delete('/rent/{id}', [RentController::class, 'destroy'])->name('rents.destroy');
    Route::get('/rents-data', [RentController::class, 'getRentData'])->name('rents.data');
    Route::get('/history', [RentController::class, 'history'])->name('rents.history');
    Route::get('/logs', [LogsController::class, 'index'])->name('rents.logs');
    Route::get('/persetujuan', [RentController::class, 'persetujuan'])->name('rents.persetujuan');
    Route::post('/persetujuan', [RentController::class, 'statusChange'])->name('rents.persetujuan_update');

    // Route::get('rents/data', [RentController::class, 'getRentData'])->name('rent.getRentData');
});

require __DIR__.'/auth.php';

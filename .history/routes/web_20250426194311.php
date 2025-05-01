<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('unit-kerja')->name('unitKerja.')->group(function () {
        Route::get('/', [UnitKerjaController::class, 'index'])->name('index');
        Route::post('/', [UnitKerjaController::class, 'store'])->name('store');
        Route::get('/{unitKerja}/edit', [UnitKerjaController::class, 'edit'])->name('edit');
        Route::put('/{unitKerja}', [UnitKerjaController::class, 'update'])->name('update');
        Route::delete('/{unitKerja}', [UnitKerjaController::class, 'destroy'])->name('destroy');
        Route::post('/delete-selected', [UnitKerjaController::class, 'destroySelected'])->name('destroySelected');
    });
});


require __DIR__.'/auth.php';

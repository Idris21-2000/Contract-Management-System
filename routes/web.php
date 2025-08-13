<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contract', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/contract', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contract/index', [ContractController::class, 'index'])->name('contracts.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

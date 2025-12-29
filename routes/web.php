<?php

use App\Http\Controllers\AsistentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// routes/api.php
Route::post('/assistant/chat', [AsistentController::class, 'chat'])
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'printPDF'])->name('transactions.print');
    Route::get('/pos', [TransactionController::class, 'pos'])->name('pos.index');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

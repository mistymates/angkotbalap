<?php

use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\UnitController as AdminUnitController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BorrowingController as UserBorrowingController;
use App\Http\Controllers\User\UnitController as UserUnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin 
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('units', AdminUnitController::class);
    Route::resource('borrowings', AdminBorrowingController::class)->only(['index', 'show']);
    Route::post('borrowings/{borrowing}/return', [AdminBorrowingController::class, 'returnUnit'])->name('borrowings.return');
    Route::get('histories', [HistoryController::class, 'index'])->name('histories.index');
});

// User
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    Route::resource('units', UserUnitController::class)->only(['index', 'show']);
    Route::resource('borrowings', UserBorrowingController::class)->only(['index', 'create', 'store']);
    Route::post('borrowings/{borrowing}/return', [UserBorrowingController::class, 'returnUnit'])->name('borrowings.return');
});

require __DIR__.'/auth.php';

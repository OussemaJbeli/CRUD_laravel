<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
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
Route::resource('products', ProductsController::class)->middleware('auth');
Route::resource('admin', UserController::class);

Route::GET('/', [UserController::class, 'index'])->name('admin.index');
Route::GET('/login_crud', [UserController::class, 'login_crud'])->name('admin.login_crud');
Route::GET('/logout_crud', [UserController::class, 'logout_crud'])->name('admin.logout_crud');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
    // ...
});

require __DIR__.'/auth.php';

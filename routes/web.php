<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::put('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/admin', \App\Http\Controllers\CreateUserController::class);

    Route::resource('/supplier', \App\Http\Controllers\SupplierController::class);

    Route::resource('/product', \App\Http\Controllers\ProductController::class);

    Route::resource('/order', \App\Http\Controllers\OrderController::class);

    Route::resource('/purchase', \App\Http\Controllers\PurchaseController::class);
});

require __DIR__.'/auth.php';

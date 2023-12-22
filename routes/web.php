<?php

use App\Http\Controllers\AdminController;
use Laravel\Fortify\Fortify;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin/')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {

        Route::view('/login', '/admin.auth.login')->name('login');

        Route::view('/register', '/admin.auth.register')->name('register');
        Route::post('login', [AdminController::class, 'login']);
    });
});

Route::prefix('eleve/')->name('eleve.')->group(function () {

    Route::middleware('guest:eleve')->group(function () {

        Route::view('/login', '/eleve.auth.login')->name('login');

        Route::view('/register', '/eleve.auth.register')->name('register');
    });
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');
});

Route::prefix('eleve')->middleware(['eleve'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('eleve.index');
});


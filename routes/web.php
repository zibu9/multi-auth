<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\HomeController;

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

    //Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminController::class, 'loginView'])->name('login');
        Route::get('/register', [AdminController::class, 'registerView'])->name('register');
        //Route::view('/register', '/admin.auth.register')->name('register');
        //Route::view('/login', '/admin.auth.login')->name('login');
        Route::post('login', [AdminController::class, 'login'])->name('login');
    //});
});

Route::prefix('eleve/')->name('eleve.')->group(function () {

   // Route::middleware('guest:eleve')->group(function () {
        Route::get('/login', [EleveController::class, 'loginView'])->name('login');
        Route::get('/register', [EleveController::class, 'registerView'])->name('register');
        Route::post('login', [EleveController::class, 'login'])->name('login');
        Route::view('/register', '/eleve.auth.register')->name('register');
    //});
});

Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});

Route::prefix('eleve')->middleware(['eleve'])->name('eleve.')->group(function () {
    Route::get('/', [EleveController::class, 'index'])->name('index');
    Route::post('/logout', [EleveController::class, 'logout'])->name('logout');
});


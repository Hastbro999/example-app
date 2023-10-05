<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
    return view('home', [
        "title" => "Halaman"
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "Tentang"
    ]);
});

Route::get('riwayat/{id}', [DashboardController::class, 'riwayat'])->middleware('auth')->name('dashboard.riwayat');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'auth']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('allRiwayat', [DashboardController::class, 'allRiwayat'])->middleware('auth')->name('dashboard.allRiwayat');

Route::post('/masuk', [DashboardController::class, 'masuk']);

Route::post('/keluar', [DashboardController::class, 'keluar']);

Route::resource('/admin', AdminController::class)->middleware('auth');

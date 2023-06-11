<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LahirController;
use App\Http\Controllers\MedisController;
use App\Http\Controllers\VisumController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\RawatJalanController;

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

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware(['auth', 'verified']);

// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');

Route::get('/', function () {
    if (Auth::check()) {
        // Jika pengguna sudah login, arahkan ke halaman lain
        return redirect('/home');
    } else {
        // Jika pengguna belum login, arahkan ke halaman login
        return view('auth.login');
    }
});


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
});

Route::resource('/home/vaksin',VaksinController::class)->middleware('auth');
Route::resource('/home/imunisasi',ImunisasiController::class)->middleware('auth');
Route::resource('/home/asuransi',AsuransiController::class)->middleware('auth');
Route::resource('/home/lahir',LahirController::class)->middleware('auth');
Route::resource('/home/rawatjalan',RawatJalanController::class)->middleware('auth');
Route::resource('/home/medis',MedisController::class)->middleware('auth');
Route::resource('/home/visum',VisumController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

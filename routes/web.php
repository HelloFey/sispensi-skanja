<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaController;
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
// pengarahan
Route::redirect('/', 'login');
Route::redirect('home', 'dashboard');
Route::redirect('/', 'dashboard');


//
// Route::get('/', function () {
//     return view('welcome');
// });


// per dashboard an
// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::post('/dashboard/export', [DashboardController::class, 'export'])->name('presensi.export');
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::resource('pelanggaran', PelanggaranController::class);
});

// Route::get('/pelanggaran-siswa', function () {
//     return view('dashboard.pelanggaran.index');
// })->middleware('auth');

// routes/web.php
// Route::middleware(['auth'])->group(function () {
//     Route::get('/presensi-harian', [PresensiController::class, 'index'])->name('presensi.index');
//     Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
//     Route::put('/presensi/{id}', [PresensiController::class, 'update'])->name('presensi.update');
//     Route::get('/presensi/export', [PresensiController::class, 'export'])->name('presensi.export');
// });

Route::resource('presensi', PresensiController::class);
Route::get('/rekap', [PresensiController::class, 'rekap'])->name('presensi.rekap');


Route::get('/rekap-semester', function () {
    return view('dashboard.rekapsemester');
})->middleware('auth');

Route::resource('siswa', SiswaController::class)->middleware('auth');
Route::resource('kelas', KelasController::class)->middleware('auth');

// Route::get('/guru', function () {
//     return view('dashboard.guru.index');
// })->middleware('auth');

Route::resource('guru', GuruController::class)->middleware('auth');


// autentikasi
Route::get('/login', [AuthController::class, 'auth'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('autentikasi');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

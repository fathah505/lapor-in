<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Halaman Welcome/Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route Dashboard - Redirect otomatis berdasarkan level user
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->level == 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('siswa.dashboard');
    }
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'ceklevel:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Pengaduan Management
    Route::get('/pengaduan', [AdminController::class, 'pengaduan'])->name('admin.pengaduan');
    Route::get('/pengaduan/{id}', [AdminController::class, 'showPengaduan'])->name('admin.pengaduan.show');
    Route::post('/pengaduan/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.pengaduan.update-status');
    
    // Tanggapan
    Route::post('/tanggapan/store', [AdminController::class, 'storeTanggapan'])->name('admin.tanggapan.store');
    
    // Kategori Management
    Route::get('/kategori', [AdminController::class, 'kategori'])->name('admin.kategori');
    Route::post('/kategori/store', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::put('/kategori/{id}', [AdminController::class, 'updateKategori'])->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [AdminController::class, 'deleteKategori'])->name('admin.kategori.delete');
    
    // User Management (khusus admin)
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    // Laporan/Reports
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/export', [AdminController::class, 'exportLaporan'])->name('admin.laporan.export');
});

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'ceklevel:siswa'])->prefix('siswa')->group(function () {
    // Dashboard
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    
    // Pengaduan
    Route::get('/pengaduan', [SiswaController::class, 'pengaduan'])->name('siswa.pengaduan');
    Route::get('/pengaduan/create', [SiswaController::class, 'createPengaduan'])->name('siswa.pengaduan.create');
    Route::post('/pengaduan/store', [SiswaController::class, 'storePengaduan'])->name('siswa.pengaduan.store');
    Route::get('/pengaduan/{id}', [SiswaController::class, 'showPengaduan'])->name('siswa.pengaduan.show');
    Route::get('/pengaduan/{id}/edit', [SiswaController::class, 'editPengaduan'])->name('siswa.pengaduan.edit');
    Route::put('/pengaduan/{id}', [SiswaController::class, 'updatePengaduan'])->name('siswa.pengaduan.update');
    Route::delete('/pengaduan/{id}', [SiswaController::class, 'deletePengaduan'])->name('siswa.pengaduan.delete');
});

/*
|--------------------------------------------------------------------------
| Profile Routes (Hanya untuk Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'ceklevel:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Tanpa Register)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
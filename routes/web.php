<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetImportExportController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VerifikatorController;
use App\Http\Controllers\ValidatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return view('welcome');
});

// ===================
// DASHBOARD
// ===================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===================
// PROFILE
// ===================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===================
// ASSET MANAGEMENT
// ===================

Route::get('/assets/{id}/export-pdf', [AssetController::class, 'exportPdf'])->name('assets.exportPdf');
Route::get('/assets/preview-pdf', [AssetController::class, 'previewPdf'])->name('assets.preview-pdf');
Route::get('/assets/export-excel', [AssetController::class, 'exportExcel'])->name('assets.export-excel');


// superadmin & admin bisa kelola asset
Route::middleware(['auth'])->group(function () {
    Route::get('/assets', [AssetController::class, 'index'])->name('assets.index');
    Route::resource('assets', AssetController::class)->except(['index']); // index udah di atas

    // export & import
    Route::get('/assets/export', [AssetImportExportController::class, 'export'])->name('assets.export');
    Route::post('/assets/import', [AssetImportExportController::class, 'import'])->name('assets.import');
});



// staf juga bisa lihat data aset (tapi read only)
Route::middleware(['auth'])->group(function () {
    Route::get('/filter-assets', [AssetController::class, 'filter'])->name('assets.filter');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/superadmin', fn() => view('dashboard.superadmin'))
        ->name('dashboard.superadmin')
        ->middleware('role:super admin');
});

Route::get('/dashboard/verifikator', [VerifikatorController::class, 'index'])
    ->name('verifikator.index');

Route::post('/dashboard/verifikator', [VerifikatorController::class, 'store'])
    ->name('verifikator.store');

Route::get('/dashboard/verifikator', fn() => view('dashboard.verifikator'))
    ->name('dashboard.verifikator')
    ->middleware('role:verifikator');

Route::get('/dashboard/validator', fn() => view('dashboard.validator'))
    ->name('dashboard.validator')
    ->middleware('role:validator');

Route::get('/dashboard/validator', [ValidatorController::class, 'index'])
    ->name('validator.index');

Route::post('/dashboard/validator', [ValidatorController::class, 'store'])
    ->name('validator.store');
// ===================

Route::get('/dashboard/guest', fn() => view('dashboard.guest'))
    ->name('dashboard.guest')
    ->middleware('role:guest');

Route::get('/dashboard/guest', [GuestController::class, 'index'])
    ->name('guest.index');

Route::post('/dashboard/guest', [GuestController::class, 'store'])
    ->name('guest.store');

Route::get('/dashboard/verifikator', function () {
    return view('dashboard.verifikator');
})->middleware(['auth', 'role:verifikator'])->name('dashboard.verifikator');


Route::get('/dashboard/validator', function () {
    return view('dashboard.validator');
})->middleware(['auth', 'role:validator'])->name('dashboard.validator');


Route::get('/dashboard/guest', function () {
    return view('dashboard.guest');
})->middleware(['auth', 'role:guest'])->name('dashboard.guest');

Route::get('/dashboard/superadmin', function () {
    return view('dashboard.superadmin');
})->middleware(['auth', 'role:super admin'])->name('dashboard.superadmin');


Route::get('/activity/logs', function () {
    return \App\Models\ActivityLog::latest()->take(10)->get();
})->name('activity.logs');

// UNIT & KATEGORI
// ===================
Route::resource('users', UserController::class);
Route::resource('validators', ValidatorController::class);
Route::resource('verifikators', VerifikatorController::class);
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
// hanya superadmin yang bisa kelola unit
Route::middleware(['auth'])->group(function () {
    Route::resource('units', UnitController::class);
});

// semua user bisa lihat kategori
Route::resource('kategoris', KategoriController::class)->only(['index', 'show']);

// ===================
// CHECK ZIP (tes extension PHP)
// ===================
Route::get('/check-zip', function () {
    return extension_loaded('zip') ? 'Zip aktif' : 'Zip tidak aktif';
});

Route::middleware(['auth'])->group(function () {
    Route::get('/teams', [App\Http\Controllers\TeamController::class, 'index'])->name('teams.index');
});

require __DIR__ . '/auth.php';

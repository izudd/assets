<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetImportExportController;
use App\Http\Controllers\KategoriController;

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

Route::get('/assets/export-pdf', [AssetController::class, 'exportPdf'])->name('assets.export.pdf');

Route::get('/assets/create', [AssetController::class, 'create'])->name('assets.create');
Route::post('/assets', [AssetController::class, 'store'])->name('assets.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/assets/export', [AssetController::class, 'export'])->name('assets.export');
    Route::post('/assets/import', [AssetController::class, 'import'])->name('assets.import');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/assets/export', [AssetImportExportController::class, 'export'])->name('assets.export');
    Route::post('/assets/import', [AssetImportExportController::class, 'import'])->name('assets.import');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('assets', AssetController::class);
});

Route::resource('units', \App\Http\Controllers\UnitController::class);


Route::resource('kategoris', KategoriController::class)->only(['index','show']);

Route::get('/check-zip', function () {
    return extension_loaded('zip') ? 'Zip aktif' : 'Zip tidak aktif';
});

require __DIR__ . '/auth.php';

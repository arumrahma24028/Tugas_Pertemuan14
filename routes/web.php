<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Buku;
use App\Models\Anggota;
 
Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');

// Fitur Export CSV
Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');

// Fitur Bulk Delete
Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');

Route::resource('buku', BukuController::class);

Route::resource('buku',BukuController::class);

Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])
     ->name('buku.kategori');

Route::resource('anggota',AnggotaController::class);


 
// Helper Function untuk membungkus HTML dengan Template Bootstrap 5
function wrapWithBootstrap($title, $content) {
    return '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>php
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container my-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    ' . $content . '
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>';
}
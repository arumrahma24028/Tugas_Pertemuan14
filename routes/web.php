<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Buku;
use App\Models\Anggota;
 
Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ROUTE BUKU
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');
Route::post('/buku/bulk-delete', [BukuController::class, 'bulkDelete'])->name('buku.bulk-delete');
Route::get('/buku/kategori/{kategori}', [BukuController::class, 'filterKategori'])->name('buku.kategori');
Route::resource('buku', BukuController::class); // Saya hapus satu karena sebelumnya ditulis 2 kali (duplicate)


// ROUTE ANGGOTA// Rute Search dan Export WAJIB ditaruh DI ATAS route resource
Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
Route::get('/anggota/export', [AnggotaController::class, 'export'])->name('anggota.export');

// Route resource untuk create, read, update, delete
Route::resource('anggota', AnggotaController::class);

 
// ==========================================
// HELPER FUNCTION
// ==========================================
// Helper Function untuk membungkus HTML dengan Template Bootstrap 5
function wrapWithBootstrap($title, $content) {
    return '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>
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
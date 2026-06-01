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

// // ========== TESTING BUKU ==========
 
// // List all buku
// Route::get('/buku', function () {
//     $bukus = Buku::all();
    
//     $html = '<div class="d-flex justify-content-between align-items-center mb-4">';
//     $html .= '    <h1 class="text-primary mb-0">📚 Daftar Buku</h1>';
//     $html .= '    <a href="/buku/create" class="btn btn-success">+ Tambah Buku</a>';
//     $html .= '</div>';
    
//     $html .= '<div class="table-responsive">';
//     $html .= '  <table class="table table-striped table-hover align-middle">';
//     $html .= '    <thead class="table-dark">';
//     $html .= '      <tr>
//                         <th>ID</th>
//                         <th>Kode</th>
//                         <th>Judul</th>
//                         <th>Kategori</th>
//                         <th>Harga</th>
//                         <th>Stok</th>
//                         <th class="text-center">Aksi</th>
//                       </tr>';
//     $html .= '    </thead>';
//     $html .= '    <tbody>';
    
//     foreach ($bukus as $buku) {
//         $stokBadge = $buku->stok == 0 
//             ? '<span class="badge bg-danger-subtle text-danger">Habis</span>' 
//             : '<span class="badge bg-primary-subtle text-primary">' . $buku->stok . '</span>';

//         $html .= '<tr>';
//         $html .= '<td>' . $buku->id . '</td>';
//         $html .= '<td><code>' . $buku->kode_buku . '</code></td>';
//         $html .= '<td class="fw-bold">' . $buku->judul . '</td>';
//         $html .= '<td><span class="badge bg-secondary">' . $buku->kategori . '</span></td>';
//         $html .= '<td>' . $buku->harga_format . '</td>';
//         $html .= '<td>' . $stokBadge . '</td>';
//         $html .= '<td class="text-center">
//                     <a href="/buku/' . $buku->id . '" class="btn btn-sm btn-info text-white me-1">Detail</a>
//                     <a href="/buku/' . $buku->id . '/edit" class="btn btn-sm btn-warning text-white">Edit</a>
//                   </td>';
//         $html .= '</tr>';
//     }
    
//     $html .= '    </tbody>';
//     $html .= '  </table>';
//     $html .= '</div>';
    
//     return wrapWithBootstrap('Daftar Buku', $html);
// });
 
// // Show single buku
// Route::get('/buku/{id}', function ($id) {
//     $buku = Buku::findOrFail($id);
    
//     $html = '<h1 class="text-primary mb-3">📖 Detail Buku</h1>';
//     $html .= '<a href="/buku" class="btn btn-secondary mb-4">&larr; Kembali</a>';
    
//     $html .= '<table class="table table-bordered bg-white">';
//     $html .= '  <tr class="table-light"><th style="width: 25%;">Field</th><th>Value</th></tr>';
//     $html .= '  <tr><td>ID</td><td>' . $buku->id . '</td></tr>';
//     $html .= '  <tr><td>Kode Buku</td><td><code>' . $buku->kode_buku . '</code></td></tr>';
//     $html .= '  <tr><td>Judul</td><td class="fw-bold">' . $buku->judul . '</td></tr>';
//     $html .= '  <tr><td>Kategori</td><td>' . $buku->kategori . '</td></tr>';
//     $html .= '  <tr><td>Pengarang</td><td>' . $buku->pengarang . '</td></tr>';
//     $html .= '  <tr><td>Penerbit</td><td>' . $buku->penerbit . '</td></tr>';
//     $html .= '  <tr><td>Tahun</td><td>' . $buku->tahun_terbit . '</td></tr>';
//     $html .= '  <tr><td>ISBN</td><td>' . $buku->isbn . '</td></tr>';
//     $html .= '  <tr><td>Harga</td><td class="text-success fw-bold">' . $buku->harga_format . '</td></tr>';
//     $html .= '  <tr><td>Stok</td><td>' . $buku->stok . '</td></tr>';
//     $html .= '  <tr><td>Tersedia?</td><td>' . ($buku->tersedia ? '<span class="text-success fw-bold">Ya</span>' : '<span class="text-danger fw-bold">Tidak</span>') . '</td></tr>';
//     $html .= '  <tr><td>Created</td><td class="text-muted">' . $buku->created_at . '</td></tr>';
//     $html .= '  <tr><td>Updated</td><td class="text-muted">' . $buku->updated_at . '</td></tr>';
//     $html .= '</table>';
    
//     return wrapWithBootstrap('Detail Buku - ' . $buku->judul, $html);
// });
 
// // ========== TESTING ANGGOTA ==========
 
// // List all anggota
// Route::get('/anggota', function () {
//     $anggotas = Anggota::all();
    
//     $html = '<h1 class="text-success mb-4">👥 Daftar Anggota</h1>';
    
//     $html .= '<div class="table-responsive">';
//     $html .= '  <table class="table table-striped table-hover align-middle">';
//     $html .= '    <thead class="table-success">';
//     $html .= '      <tr>
//                         <th>ID</th>
//                         <th>Kode</th>
//                         <th>Nama</th>
//                         <th>Email</th>
//                         <th>Umur</th>
//                         <th>Status</th>
//                         <th class="text-center">Aksi</th>
//                       </tr>';
//     $html .= '    </thead>';
//     $html .= '    <tbody>';
    
//     foreach ($anggotas as $anggota) {
//         $statusBadge = $anggota->status == 'Aktif' 
//             ? '<span class="badge bg-success">Aktif</span>' 
//             : '<span class="badge bg-danger">' . $anggota->status . '</span>';

//         $html .= '<tr>';
//         $html .= '<td>' . $anggota->id . '</td>';
//         $html .= '<td><code>' . $anggota->kode_anggota . '</code></td>';
//         $html .= '<td class="fw-bold">' . $anggota->nama . '</td>';
//         $html .= '<td>' . $anggota->email . '</td>';
//         $html .= '<td>' . $anggota->umur . ' tahun</td>';
//         $html .= '<td>' . $statusBadge . '</td>';
//         $html .= '<td class="text-center"><a href="/anggota/' . $anggota->id . '" class="btn btn-sm btn-outline-success">Detail</a></td>';
//         $html .= '</tr>';
//     }
    
//     $html .= '    </tbody>';
//     $html .= '  </table>';
//     $html .= '</div>';
    
//     return wrapWithBootstrap('Daftar Anggota', $html);
// });
 
// // Show single anggota
// Route::get('/anggota/{id}', function ($id) {
//     $anggota = Anggota::findOrFail($id);
    
//     $html = '<h1 class="text-success mb-3">👤 Detail Anggota</h1>';
//     $html .= '<a href="/anggota" class="btn btn-secondary mb-4">&larr; Kembali</a>';
    
//     $html .= '<table class="table table-bordered bg-white">';
//     $html .= '  <tr class="table-light"><th style="width: 25%;">Field</th><th>Value</th></tr>';
//     $html .= '  <tr><td>Kode Anggota</td><td><code>' . $anggota->kode_anggota . '</code></td></tr>';
//     $html .= '  <tr><td>Nama</td><td class="fw-bold">' . $anggota->nama . '</td></tr>';
//     $html .= '  <tr><td>Email</td><td>' . $anggota->email . '</td></tr>';
//     $html .= '  <tr><td>Telepon</td><td>' . $anggota->telepon . '</td></tr>';
//     $html .= '  <tr><td>Alamat</td><td>' . $anggota->alamat . '</td></tr>';
//     $html .= '  <tr><td>Tanggal Lahir</td><td>' . $anggota->tanggal_lahir->format('d-m-Y') . '</td></tr>';
//     $html .= '  <tr><td>Umur</td><td>' . $anggota->umur . ' tahun</td></tr>';
//     $html .= '  <tr><td>Jenis Kelamin</td><td>' . $anggota->jenis_kelamin . '</td></tr>';
//     $html .= '  <tr><td>Pekerjaan</td><td>' . $anggota->pekerjaan . '</td></tr>';
//     $html .= '  <tr><td>Tanggal Daftar</td><td>' . $anggota->tanggal_daftar->format('d-m-Y') . '</td></tr>';
//     $html .= '  <tr><td>Lama Anggota</td><td>' . $anggota->lama_anggota . ' hari</td></tr>';
//     $html .= '  <tr><td>Status</td><td>' . ($anggota->status == 'Aktif' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>') . '</td></tr>';
//     $html .= '</table>';
    
//     return wrapWithBootstrap('Detail Anggota - ' . $anggota->nama, $html);
// });
 
// // Testing Scope & Query
// Route::get('/test-query', function () {
//     $html = '<h1 class="text-dark mb-4">⚙️ Testing Query Eloquent</h1>';
//     $html .= '<div class="row">';
    
//     // Buku tersedia
//     $tersedia = Buku::tersedia()->get();
//     $html .= '<div class="col-md-4 mb-4">';
//     $html .= '  <div class="card border-primary h-100">';
//     $html .= '    <div class="card-header bg-primary text-white">Buku Tersedia (Stok > 0): ' . $tersedia->count() . '</div>';
//     $html .= '    <ul class="list-group list-group-flush">';
//     foreach ($tersedia as $buku) {
//         $html .= '  <li class="list-group-item">' . $buku->judul . ' <span class="badge bg-blue text-primary-emphasis float-end">' . $buku->stok . '</span></li>';
//     }
//     $html .= '    </ul>';
//     $html .= '  </div>';
//     $html .= '</div>';
    
//     // Buku Programming
//     $programming = Buku::kategori('Programming')->get();
//     $html .= '<div class="col-md-4 mb-4">';
//     $html .= '  <div class="card border-info h-100">';
//     $html .= '    <div class="card-header bg-info text-white">Buku Programming: ' . $programming->count() . '</div>';
//     $html .= '    <ul class="list-group list-group-flush">';
//     foreach ($programming as $buku) {
//         $html .= '  <li class="list-group-item">' . $buku->judul . '</li>';
//     }
//     $html .= '    </ul>';
//     $html .= '  </div>';
//     $html .= '</div>';
    
//     // Anggota Aktif
//     $aktif = Anggota::aktif()->get();
//     $html .= '<div class="col-md-4 mb-4">';
//     $html .= '  <div class="card border-success h-100">';
//     $html .= '    <div class="card-header bg-success text-white">Anggota Aktif: ' . $aktif->count() . '</div>';
//     $html .= '    <ul class="list-group list-group-flush">';
//     foreach ($aktif as $anggota) {
//         $html .= '  <li class="list-group-item">' . $anggota->nama . ' <small class="text-muted d-block">' . $anggota->email . '</small></li>';
//     }
//     $html .= '    </ul>';
//     $html .= '  </div>';
//     $html .= '</div>';
    
//     $html .= '</div>'; // close row
    
//     return wrapWithBootstrap('Testing Query Eloquent', $html);
// });

// // ========== TESTING KATEGORI (Fitur Baru Tugas 1) ==========
// Route::get('/kategori', function () {
//     $kategoris = Kategori::all();
    
//     $html = '<h1 class="text-dark mb-4">🗂️ Daftar Kategori</h1>';
//     $html .= '<div class="row">';
    
//     foreach ($kategoris as $kat) {
//         $html .= '<div class="col-md-4 mb-3">';
//         $html .= '  <div class="card h-100 border-' . $kat->warna . '">';
//         $html .= '    <div class="card-header bg-' . $kat->warna . ' text-white fw-bold">';
//         $html .= '      <i class="bi bi-' . $kat->icon . '"></i> ' . $kat->nama_kategori;
//         $html .= '    </div>';
//         $html .= '    <div class="card-body">';
//         $html .= '      <p class="card-text text-muted">' . ($kat->deskripsi ?? 'Tidak ada deskripsi.') . '</p>';
//         $html .= '    </div>';
//         $html .= '  </div>';
//         $html .= '</div>';
//     }
    
//     $html .= '</div>';
//     return wrapWithBootstrap('Daftar Kategori', $html);
// });

// // ========== TESTING ACCESSOR & SCOPE (TUGAS 2) ==========
// Route::get('/test-accessor-scope', function () {
//     $html = '<h1 class="text-center text-dark mb-5">Model Accessor & Scope </h1>';
    
//     // ----------------------------------------------------
//     // 1. DATA BUKU
//     // ----------------------------------------------------
//     $html .= '<h3 class="text-primary border-bottom pb-2 mb-3">📚 Model Buku</h3>';
    
//     // A. Semua Buku dengan status_stok_badge & tahun_label
//     $html .= '<h5>Semua Buku</h5>';
//     $html .= '<div class="table-responsive mb-4"><table class="table table-bordered table-striped align-middle">';
//     $html .= '<thead class="table-primary"><tr><th>Judul Buku</th><th>Tahun</th><th>Label</th><th>Stok</th><th>Status Badge</th></tr></thead><tbody>';
//     foreach (Buku::all() as $b) {
//         $html .= "<tr><td>{$b->judul}</td><td>{$b->tahun_terbit}</td><td><span class='badge bg-dark'>{$b->tahun_label}</span></td><td>{$b->stok}</td><td>{$b->status_stok_badge}</td></tr>";
//     }
//     $html .= '</tbody></table></div>';

//     // B. Scope Buku Terbaru
//     $html .= '<h5>Filter Buku Terbaru (Tahun Terbit 2024 atau Lebih)</h5>';
//     $html .= '<ul>';
//     foreach (Buku::terbaru()->get() as $b) {
//         $html .= "<li><strong>{$b->judul}</strong> (Tahun: {$b->tahun_terbit})</li>";
//     }
//     $html .= '</ul>';

//     // C. Scope Stok Menipis
//     $html .= '<h5 class="mt-3">Filter Stok Buku(Stok Kurang dari 5):</h5>';
//     $html .= '<ul>';
//     foreach (Buku::stokMenipis()->get() as $b) {
//         $html .= "<li><strong>{$b->judul}</strong> - Sisa Stok: <span class='text-danger fw-bold'>{$b->stok}</span></li>";
//     }
//     $html .= '</ul><br>';

//     // ----------------------------------------------------
//     // 2. DATA ANGGOTA
//     // ----------------------------------------------------
//     $html .= '<h3 class="text-success border-bottom pb-2 mb-3">👥 Pengujian pada Model Anggota</h3>';
    
//     // A. Semua Anggota dengan status_badge & kategori_usia
//     $html .= '<h5>Semua Anggota</h5>';
//     $html .= '<div class="table-responsive mb-4"><table class="table table-bordered table-striped align-middle">';
//     $html .= '<thead class="table-success"><tr><th>Nama Anggota</th><th>Umur</th><th>Kategori Usia</th><th>Status</th></tr></thead><tbody>';
//     foreach (Anggota::all() as $a) {
//         $html .= "<tr><td>{$a->nama}</td><td>{$a->umur} tahun</td><td><span class='badge bg-outline-secondary text-dark border'>{$a->kategori_usia}</span></td><td>{$a->status_badge}</td></tr>";
//     }
//     $html .= '</tbody></table></div>';

//     // B. Scope Anggota Terdaftar Bulan Ini
//     $html .= '<h5>Filter Scope Anggota Terdaftar Bulan Ini</h5>';
//     $html .= '<ul>';
//     $anggotaBulanIni = Anggota::terdaftarBulanIni()->get();
//     if ($anggotaBulanIni->isEmpty()) {
//         $html .= "<li><em class='text-muted'>Tidak ada anggota yang terdaftar pada bulan ini.</em></li>";
//     } else {
//         foreach ($anggotaBulanIni as $a) {
//             $html .= "<li><strong>{$a->nama}</strong> (Terdaftar: " . \Carbon\Carbon::parse($a->tanggal_daftar)->format('d-m-Y') . ")</li>";
//         }
//     }
//     $html .= '</ul>';

//     return wrapWithBootstrap('Testing Accessor & Scope', $html);
// });
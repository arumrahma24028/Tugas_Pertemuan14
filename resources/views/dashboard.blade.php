@extends('layouts.app')
 
@section('title', 'Dashboard Perpustakaan')
 
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="bi bi-speedometer2 text-primary"></i> Dashboard Sistem Perpustakaan
            </h1>
            <p class="text-muted mb-0">Ringkasan data dan aktivitas perpustakaan saat ini.</p>
        </div>
        <span class="badge bg-primary p-2">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body py-3 d-flex align-items-center flex-wrap gap-2">
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-book"></i> Daftar Buku
                    </a>
                    <a href="{{ route('buku.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Buku Baru
                    </a>
                    <a href="{{ route('anggota.index') }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-people"></i> Manajemen Anggota
                    </a>
                    <a href="#" class="btn btn-sm btn-outline-info">
                        <i class="bi bi-arrow-left-right"></i> Transaksi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
 
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-start border-primary border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1 fw-bold">Total Koleksi Buku</h6>
                            <h2 class="mb-0 fw-bold text-primary">{{ $totalBuku }}</h2>
                            <span class="text-success small fw-semibold">{{ $bukuTersedia }} Tersedia</span> | 
                            <span class="text-danger small fw-semibold">{{ $bukuHabis }} Habis</span>
                        </div>
                        <div class="text-primary opacity-50">
                            <i class="bi bi-bookshelf" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-start border-success border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1 fw-bold">Total Anggota</h6>
                            <h2 class="mb-0 fw-bold text-success">{{ $totalAnggota }}</h2>
                            <span class="text-success small fw-semibold">{{ $anggotaAktif }} Aktif</span> | 
                            <span class="text-secondary small fw-semibold">{{ $anggotaNonaktif }} Pasif</span>
                        </div>
                        <div class="text-success opacity-50">
                            <i class="bi bi-people-fill" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-start border-danger border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1 fw-bold">Stok Buku Habis</h6>
                            <h2 class="mb-0 fw-bold text-danger">{{ $bukuHabis }}</h2>
                            <p class="text-muted small mb-0 mt-1">Perlu restock segera</p>
                        </div>
                        <div class="text-danger opacity-50">
                            <i class="bi bi-exclamation-triangle-fill" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-start border-info border-4 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase small mb-1 fw-bold">Status Sistem</h6>
                            <h5 class="mb-0 fw-bold text-info mt-2"><i class="bi bi-cloud-check-fill"></i> Optimal</h5>
                            <p class="text-muted small mb-0 mt-1">Laravel 12 & Bootstrap 5</p>
                        </div>
                        <div class="text-info opacity-50">
                            <i class="bi bi-cpu" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-secondary">
                        <i class="bi bi-journal-plus text-primary"></i> 5 Buku Terbaru
                    </h5>
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-link p-0 text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bukuTerbaru as $buku)
                                <tr>
                                    <td>
                                        <a href="{{ route('buku.show', $buku->id) }}" class="fw-semibold text-decoration-none text-dark">
                                            {{ Str::limit($buku->judul, 35) }}
                                        </a>
                                        <div class="small text-muted">{{ $buku->pengarang }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary small">{{ $buku->kategori }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $buku->stok > 0 ? 'success' : 'danger' }}">
                                            {{ $buku->stok }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-folder-x display-6 block text-secondary"></i><br>Belum ada data buku.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold text-secondary">
                        <i class="bi bi-person-plus text-success"></i> 5 Anggota Baru
                    </h5>
                    <a href="{{ route('anggota.index') }}" class="btn btn-sm btn-link p-0 text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Anggota</th>
                                    <th>Kontak / Email</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($anggotaTerbaru as $anggota)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $anggota->nama }}</div>
                                        <div class="small text-muted">ID: {{ $anggota->id_anggota ?? $anggota->id }}</div>
                                    </td>
                                    <td class="small text-muted">
                                        {{ $anggota->email ?? $anggota->telepon ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ ($anggota->status ?? 'Aktif') == 'Aktif' ? 'success' : 'secondary' }}">
                                            {{ $anggota->status ?? 'Aktif' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-person-x display-6 text-secondary"></i><br>Belum ada data anggota baru.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
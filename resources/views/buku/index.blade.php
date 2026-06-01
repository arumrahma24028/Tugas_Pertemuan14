@extends('layouts.app')
 
@section('title', 'Daftar Buku')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Buku
    </a>
</div>
 
{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
{{-- Form Search & Filter Advanced --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light fw-bold text-secondary">
    </div>
    <div class="card-body">
        <form action="{{ route('buku.search') }}" method="GET">
            <div class="row g-3">
                {{-- Input Keyword --}}
                <div class="col-md-4">
                    <label class="form-label small text-muted fw-bold">Kata Kunci</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="keyword" class="form-control" placeholder="Cari judul, pengarang, penerbit..." value="{{ request('keyword') }}">
                    </div>
                </div>

                {{-- Dropdown Kategori --}}
                <div class="col-md-3">
                    <label class="form-label small text-muted fw-bold">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Programming" {{ request('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                        <option value="Database" {{ request('kategori') == 'Database' ? 'selected' : '' }}>Database</option>
                        <option value="Web Design" {{ request('kategori') == 'Web Design' ? 'selected' : '' }}>Web Design</option>
                        <option value="Networking" {{ request('kategori') == 'Networking' ? 'selected' : '' }}>Networking</option>
                        <option value="Data Science" {{ request('kategori') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                    </select>
                </div>

                {{-- Dropdown Tahun Terbit --}}
                <div class="col-md-2">
                    <label class="form-label small text-muted fw-bold">Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua</option>
                        @foreach($listTahun ?? [] as $thn)
                            <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown Status Ketersediaan --}}
                <div class="col-md-3">
                    <label class="form-label small text-muted fw-bold">Status Stok</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                    </select>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-end gap-2 mt-3 pt-2 border-top">
                @if(request()->hasAny(['keyword', 'kategori', 'tahun', 'status']))
                    <a href="{{ route('buku.index') }}" class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                        <i class="bi bi-x-circle me-1"></i> Reset Filter
                    </a>
                @endif
                <button type="submit" class="btn btn-sm btn-primary d-flex align-items-center">
                    <i class="bi bi-filter me-1"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>
</div>
 
{{-- Daftar Buku Menggunakan Reusable Component --}}
@forelse ($bukus as $buku)
    <x-buku-card :buku="$buku" :show-actions="true" />
@empty
    <div class="alert alert-info shadow-sm border-0">
        <i class="bi bi-info-circle-fill"></i>
        Tidak ada data buku
        @isset($kategori)
            dengan kategori <strong>{{ $kategori }}</strong>
        @endisset
    </div>
@endforelse
 
@if ($bukus->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
            @isset($kategori)
                dari kategori <strong>{{ $kategori }}</strong>
            @endisset
        </p>
    </div>
@endif
@endsection
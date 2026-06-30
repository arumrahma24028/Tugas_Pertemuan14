<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    {{-- Container Pembungkus agar rapi --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>
                        <i class="bi bi-book"></i>
                        Daftar Buku
                    </h1>
                    <div class="d-flex gap-2">
                        <a href="{{ route('buku.export') }}" class="btn btn-success">
                            <i class="bi bi-download"></i> Export CSV
                        </a>
                        <a href="{{ route('buku.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah Buku
                        </a>
                    </div>
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
                        Filter & Pencarian
                    </div>
                    <div class="card-body">
                        <form action="{{ route('buku.index') }}" method="GET">
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
                
                {{-- Form Bulk Delete --}}
                <form action="{{ route('buku.bulk-delete') }}" method="POST" id="form-bulk-delete">
                    @csrf

                    @if ($bukus->count() > 0)
                        {{-- Bar Kontrol Massal (Select All & Tombol Delete Massal) --}}
                        <div class="card card-body bg-light mb-3 shadow-sm py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    {{-- Spesifikasi: Select All Checkbox --}}
                                    <input class="form-check-input border-secondary" type="checkbox" id="select-all">
                                    <label class="form-check-label fw-bold text-secondary" for="select-all">
                                        Pilih Semua Buku
                                    </label>
                                </div>
                                <button type="button" id="btn-bulk-delete" class="btn btn-sm btn-danger px-3 shadow-sm">
                                    <i class="bi bi-trash-fill"></i> Hapus Sekaligus
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- Daftar Buku Menggunakan Reusable Component --}}
                    @forelse ($bukus as $buku)
                        {{-- Kita bungkus card ke dalam container flexbox agar checkbox berdampingan rapi --}}
                        <div class="d-flex align-items-center mb-3 group-checkbox-card">
                            <div class="me-3 ps-2">
                                {{-- Spesifikasi: Checkbox Individual --}}
                                <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}" class="form-check-input border-primary p-2 shadow-sm">
                            </div>
                            <div class="flex-grow-1">
                                <x-buku-card :buku="$buku" :show-actions="true" />
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info shadow-sm border-0">
                            <i class="bi bi-info-circle-fill"></i>
                            Tidak ada data buku
                            @isset($kategori)
                                dengan kategori <strong>{{ $kategori }}</strong>
                            @endisset
                        </div>
                    @endforelse
                </form>
                
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
                {{-- Penutup @if yang sebelumnya terlewat --}}

            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    // Script Select All
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
            cb.checked = this.checked;
        });
    });

    document.getElementById('btn-bulk-delete').addEventListener('click', function(e) {
        e.preventDefault();
        
        // Memeriksa apakah ada buku yang dicentang
        const checkedBoxes = document.querySelectorAll('input[name="buku_ids[]"]:checked');
        const form = document.getElementById('form-bulk-delete');
        
        if (checkedBoxes.length === 0) {
            Swal.fire({
                title: 'Peringatan',
                text: 'Silakan pilih minimal satu buku yang ingin dihapus!',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
            });
            return;
        }

        // Tampilkan SweetAlert jika ada buku yang dipilih
        Swal.fire({
            title: 'Konfirmasi Hapus Massal',
            text: `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} buku yang dipilih sekaligus?`,
            icon: 'warning', 
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Eksekusi submit form ke controller jika user memilih "Ya"
            }
        });
    });
</script>
@endpush
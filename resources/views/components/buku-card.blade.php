<div class="card mb-3 shadow-sm border-0 bg-white">
    <div class="card-body">
        <div class="row align-items-center">
            {{-- Bagian Cover / Icon Kategori --}}
            <div class="col-md-2 text-center border-end py-2">
                <i class="bi bi-book text-primary" style="font-size: 4rem;"></i>
                <div class="mt-2">
                    <span class="badge bg-{{ $buku->kategori == 'Programming' ? 'primary' : ($buku->kategori == 'Database' ? 'success' : ($buku->kategori == 'Web Design' ? 'info' : ($buku->kategori == 'Networking' ? 'warning' : 'danger'))) }}">
                        {{ $buku->kategori }}
                    </span>
                </div>
            </div>
            
            {{-- Bagian Detail Buku --}}
            <div class="col-md-7 py-2">
                <h5 class="card-title mb-1 fw-bold">
                    <a href="{{ route('buku.show', $buku->id) }}" class="text-decoration-none text-dark hover-primary">
                        {{ $buku->judul }}
                    </a>
                </h5>
                
                <p class="card-text text-muted small mb-2">
                    <i class="bi bi-person-fill text-secondary"></i> {{ $buku->pengarang }} <span class="mx-1">|</span> 
                    <i class="bi bi-building text-secondary"></i> {{ $buku->penerbit }} <span class="mx-1">|</span> 
                    <i class="bi bi-calendar-event text-secondary"></i> {{ $buku->tahun_terbit }}
                </p>
                
                @if ($buku->isbn)
                    <p class="card-text small text-muted mb-2">
                        <i class="bi bi-upc"></i> <strong>ISBN:</strong> {{ $buku->isbn }}
                    </p>
                @endif
                
                @if ($buku->deskripsi)
                    <p class="card-text text-secondary small mb-0">
                        {{ Str::limit($buku->deskripsi, 140) }}
                    </p>
                @endif
            </div>
            
            {{-- Bagian Harga, Stok, dan Actions --}}
            <div class="col-md-3 text-end py-2">
                <h4 class="text-success fw-bold mb-1">
                    {{ $buku->harga_format ?? 'Rp ' . number_format($buku->harga, 0, ',', '.') }}
                </h4>
                
                <div class="mb-3">
                    @if ($buku->stok > 0)
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                            <i class="bi bi-check-circle-fill"></i> Tersedia
                        </span>
                        <div class="text-muted small mt-1">
                            Stok: <strong>{{ $buku->stok }}</strong> unit
                        </div>
                    @else
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                            <i class="bi bi-x-circle-fill"></i> Habis
                        </span>
                    @endif
                </div>
                
                {{-- Kondisi jika properti showActions aktif bernilai true --}}
                @if($showActions)
                    <div class="btn-group-vertical d-grid gap-2">
                        <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        
                        {{-- Delete Button dengan SweetAlert --}}
                        <form action="{{ route('buku.destroy', $buku->id) }}" 
                            method="POST" 
                            class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger w-100 btn-delete" 
                                    data-judul="{{ $buku->judul }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
@once
<script>
    document.addEventListener('click', function(e) {
        const targetButton = e.target.closest('.btn-delete');
        
        if (targetButton) {
            e.preventDefault();
            const form = targetButton.closest('form');
            const judul = targetButton.getAttribute('data-judul');
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
</script>
@endonce
@endpush
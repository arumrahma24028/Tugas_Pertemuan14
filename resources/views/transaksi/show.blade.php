<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header Judul & Tombol Kembali --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>
                        <i class="bi bi-info-square"></i>
                        Detail Transaksi: <code>{{ $transaksi->kode_transaksi }}</code>
                    </h1>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                @if($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
                    <div class="alert alert-danger mb-4">
                        <h5 class="mb-2">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Peringatan!
                        </h5>
                        <p class="mb-1">
                            Buku ini telah melewati batas waktu pengembalian selama
                            <strong>{{ $transaksi->terlambat }} hari</strong>.
                        </p>
                        <p class="mb-0">
                            Estimasi denda saat ini:
                            <strong class="text-danger">
                                Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}
                            </strong>
                        </p>
                    </div>
                @endif

                
                {{-- Card Info Peminjam & Buku --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 bg-light">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-person"></i> Data Peminjam</h6>
                                <table class="table table-borderless mb-0 table-sm bg-transparent">
                                    <tr>
                                        <td width="35%" class="text-muted">Nama Anggota</td>
                                        <td>: <strong>{{ $transaksi->anggota->nama }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kode Anggota</td>
                                        <td>: {{ $transaksi->anggota->kode_anggota }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 bg-light">
                            <div class="card-body">
                                <h6 class="fw-bold text-success mb-3"><i class="bi bi-book"></i> Data Buku</h6>
                                <table class="table table-borderless mb-0 table-sm bg-transparent">
                                    <tr>
                                        <td width="35%" class="text-muted">Judul Buku</td>
                                        <td>: <strong>{{ $transaksi->buku->judul }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Kode Buku</td>
                                        <td>: {{ $transaksi->buku->kode_buku }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card Status, Tanggal & Denda --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold py-3">
                        <i class="bi bi-calendar-check"></i> Status & Informasi Denda
                    </div>
                    <div class="card-body">
                        <div class="row text-center mb-4">
                            <div class="col-md-3">
                                <h6 class="text-muted small text-uppercase">Tanggal Pinjam</h6>
                                <h5 class="mb-0">{{ $transaksi->tanggal_pinjam->format('d M Y') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted small text-uppercase">Batas Kembali</h6>
                                <h5 class="mb-0">{{ $transaksi->tanggal_kembali->format('d M Y') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted small text-uppercase">Status</h6>
                                @if($transaksi->status == 'Dipinjam')
                                    @if($transaksi->terlambat > 0)
                                        <span class="badge bg-danger px-3 py-2">
                                            Terlambat {{ $transaksi->terlambat }} Hari
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            Sedang Dipinjam
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-success px-3 py-2">
                                        Sudah Dikembalikan
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h6 class="text-muted small text-uppercase">Tgl Dikembalikan</h6>
                                @if($transaksi->tanggal_dikembalikan)
                                    <h5 class="text-success mb-0">{{ \Carbon\Carbon::parse($transaksi->tanggal_dikembalikan)->format('d M Y') }}</h5>
                                @else
                                    <h5 class="text-muted mb-0">-</h5>
                                @endif
                            </div>
                        </div>
                        
                        <div class="p-3 bg-light rounded d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Denda Keterlambatan:</h6>
                                @if($transaksi->status == 'Dikembalikan')
                                    @if($transaksi->denda > 0)
                                        <h4 class="text-danger fw-bold mb-0">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</h4>
                                        <small class="text-danger">Terdapat keterlambatan pengembalian buku.</small>
                                    @else
                                        <h4 class="text-success fw-bold mb-0">Rp 0</h4>
                                        <small class="text-success">Buku dikembalikan tepat waktu.</small>
                                    @endif
                                @else
                                    {{-- Hitung dan tampilkan estimasi denda berjalan jika buku belum dikembalikan --}}
                                    @php
                                        $hariTerlambat = $transaksi->terlambat;
                                        $estimasiDenda = $hariTerlambat * 5000;
                                    @endphp
                                    
                                    @if($estimasiDenda > 0)
                                        <h4 class="text-danger fw-bold mb-0">Estimasi: Rp {{ number_format($estimasiDenda, 0, ',', '.') }}</h4>
                                        <small class="text-danger">Terlambat {{ $hariTerlambat }} hari (Rp 5.000/hari)</small>
                                    @else
                                        <h4 class="text-muted fw-bold mb-0">-</h4>
                                        <small class="text-muted">Belum ada denda (masih dalam masa pinjam).</small>
                                    @endif
                                @endif
                            </div>
                            
                            <div>
                                @if($transaksi->status == 'Dipinjam')
                                    <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-lg shadow" 
                                                onclick="return confirm('Pastikan fisik buku dalam keadaan baik. Lanjutkan proses pengembalian?')">
                                            <i class="bi bi-box-arrow-in-down"></i> Kembalikan Buku
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
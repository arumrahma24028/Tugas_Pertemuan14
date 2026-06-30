<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Transaksi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('transaksi.laporan') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="{{ request('tanggal_mulai') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ request('tanggal_selesai') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua</option>
                                <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Anggota</label>
                            <select name="anggota_id" class="form-select">
                                <option value="">Semua Anggota</option>
                                @foreach($anggotas as $a)
                                    <option value="{{ $a->id }}" {{ request('anggota_id') == $a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 align-self-end">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card p-4 shadow-sm">
                <div class="d-flex justify-content-between mb-3">
                    <h4>Total: {{ $transaksis->count() }} Transaksi | Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}</h4>
                    <a href="{{ route('transaksi.export-pdf', request()->all()) }}"
                    class="btn btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i>
                        Export PDF
                    </a>
                </div>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr><th>No</th><th>Kode</th><th>Anggota</th><th>Buku</th><th>Status</th><th>Denda</th></tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->kode_transaksi }}</td>
                            <td>{{ $t->anggota->nama ?? '-' }}</td>
                            <td>{{ $t->buku->judul ?? '-' }}</td>
                            <td>{{ $t->status }}</td>
                            <td>Rp {{ number_format($t->denda, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center">Data tidak ditemukan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
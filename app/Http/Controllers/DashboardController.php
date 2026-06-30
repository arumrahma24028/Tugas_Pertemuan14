<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Buku
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();

        // 2. Statistik Anggota
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count(); 
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();

        // 3. Data Terbaru
        $bukuTerbaru = Buku::latest()->take(5)->get();
        $anggotaTerbaru = Anggota::latest()->take(5)->get();

        // 4. Data Transaksi Terlambat
        $terlambats = Transaksi::where('status', 'Dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->with(['anggota', 'buku'])
            ->get();

        // 5. Kirim semua data dalam SATU return view
        return view('dashboard', compact(
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif',
            'bukuTerbaru',
            'anggotaTerbaru',
            'terlambats'
        ));
    }
}
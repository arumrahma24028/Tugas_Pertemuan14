<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;

class DashboardController extends Controller
{
    /**
     * Display the dashboard summary.
     */
    public function index()
    {
        // 1. Statistik Buku
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', 0)->count();

        // 2. Statistik Anggota (Asumsi status disimpan di kolom 'status' / 'is_active')
        // Sesuaikan nama kolom jika berbeda di database Anda (misal: status = 'Aktif')
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count(); 
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();

        // 3. Ambil 5 Data Terbaru
        $bukuTerbaru = Buku::latest()->take(5)->get();
        $anggotaTerbaru = Anggota::latest()->take(5)->get();

        // 4. Return view dengan data compact
        return view('dashboard', compact(
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif',
            'bukuTerbaru',
            'anggotaTerbaru'
        ));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'status',
        'denda',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    /**
     * Relasi ke Anggota
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Relasi ke Buku
     */
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    /**
     * Accessor Durasi Peminjaman
     */
    public function getDurasiPeminjamanAttribute()
    {
        if ($this->tanggal_dikembalikan) {
            return $this->tanggal_pinjam->diffInDays($this->tanggal_dikembalikan);
        }

        return $this->tanggal_pinjam->diffInDays(now());
    }

    /**
     * Accessor Jumlah Hari Terlambat
     */
    public function getTerlambatAttribute()
    {
        // Jika transaksi sudah dikembalikan
        if ($this->status == 'Dikembalikan') {

            if (
                $this->tanggal_dikembalikan &&
                $this->tanggal_dikembalikan->gt($this->tanggal_kembali)
            ) {
                return $this->tanggal_kembali
                    ->startOfDay()
                    ->diffInDays(
                        $this->tanggal_dikembalikan->startOfDay()
                    );
            }

            return 0;
        }

    // Jika masih dipinjam dan sudah lewat jatuh tempo
    if (
        $this->status == 'Dipinjam' &&
        today()->gt($this->tanggal_kembali)
    ) {
        return $this->tanggal_kembali
            ->startOfDay()
            ->diffInDays(today());
    }

    return 0;
}
    /**
     * Accessor Badge Status
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->status == 'Dipinjam') {

            if ($this->terlambat > 0) {
                return '<span class="badge bg-danger">Terlambat ' . $this->terlambat . ' Hari</span>';
            }

            return '<span class="badge bg-warning text-dark">Dipinjam</span>';
        }

        return '<span class="badge bg-success">Dikembalikan</span>';
    }
}
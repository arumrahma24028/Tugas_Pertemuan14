<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriList = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi' => 'Buku seputar pengembangan perangkat lunak dan bahasa pemrograman.',
                'icon' => 'code-slash',
                'warna' => 'primary',
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi' => 'Buku seputar administrasi, perancangan, dan optimasi basis data.',
                'icon' => 'database',
                'warna' => 'success',
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi' => 'Buku panduan UI/UX, desain layout, rancangan antarmuka web modern.',
                'icon' => 'palette',
                'warna' => 'info',
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi' => 'Buku infrastruktur jaringan komputer, routing, switching, dan cyber security.',
                'icon' => 'wifi',
                'warna' => 'warning',
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi' => 'Buku analisis data, machine learning, kecerdasan buatan (AI), dan statistik.',
                'icon' => 'graph-up',
                'warna' => 'danger',
            ],
        ];

        foreach ($kategoriList as $kategori) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $kategori['nama_kategori']],
                $kategori
            );
        }
    }
}
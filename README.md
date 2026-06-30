# Tugas Praktikum Pemprograman Web II

## Nama

Nama : Arum Rahma Putri Sabrina

NIM : 60324028

Mata Kuliah : Pemprograman Web II (A)


---

# Tugas 1 - Fitur Pengembalian Buku (40%)

## Fitur

### 1. Detail Transaksi

Pada halaman detail transaksi tersedia tombol **Kembalikan Buku** untuk melakukan proses pengembalian buku.

### 2. Perhitungan Denda

Sistem akan menghitung denda secara otomatis apabila buku dikembalikan melewati batas tanggal kembali.

Ketentuan:

- Denda Rp5.000 per hari
- Tidak ada denda apabila dikembalikan tepat waktu

### 3. Update Status

Setelah buku dikembalikan maka:

- Status berubah menjadi **Dikembalikan**
- Tanggal dikembalikan tersimpan otomatis
- Total denda disimpan ke database

### 4. Update Stok Buku

Saat proses pengembalian berhasil, stok buku otomatis bertambah 1.

## Dokumentasi

### Detail transaksi & tombol kembalikan

![Detail Transaksi](image/tugas14_01_1.png)

### Perhitungan denda

![Perhitungan Denda](image/tugas14_01_2.png)

### Status berubah & stok bertambah

![Status Dikembalikan](image/tugas14_01_3.png)

---

# Tugas 2 - Laporan Transaksi (30%)

## Halaman Laporan

URL:

```
/transaksi/laporan
```

## Filter

- Range tanggal
- Status transaksi
- Anggota

## Informasi yang ditampilkan

- Daftar transaksi
- Total transaksi
- Total denda

## Export PDF

Laporan dapat diunduh dalam bentuk PDF menggunakan package Laravel DomPDF.

## Dokumentasi

### Halaman laporan transaksi

![Laporan Transaksi](image/tugas14_02_1.png)

### Filter laporan

![Filter Laporan](image/tugas14_02_2.png)

### Download PDF

![Hasil Filter](image/tugas14_02_3.png)

### Hasil PDF

![Export PDF](image/tugas14_02_4.png)

---

# Tugas 3 - Notifikasi Terlambat (30%)

## Dashboard

Dashboard memiliki widget **Buku Terlambat** yang menampilkan:

- Jumlah transaksi terlambat
- Daftar anggota yang terlambat
- Buku yang dipinjam
- Lama keterlambatan

## Badge Terlambat

Pada halaman daftar transaksi akan muncul badge merah apabila transaksi telah melewati batas pengembalian.

## Reminder

Pada halaman detail transaksi akan muncul peringatan apabila buku sudah melewati batas pengembalian.

## Dokumentasi

### Dashboard Buku Terlambat

![Dashboard Buku Terlambat](image/tugas14_03_1.png)

### Badge & Reminder Terlambat

![Badge Terlambat](image/tugas14_03_2.png)

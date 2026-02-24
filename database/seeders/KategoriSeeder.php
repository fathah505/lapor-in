<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Fasilitas Kelas'],
            ['nama_kategori' => 'Laboratorium Komputer'],
            ['nama_kategori' => 'Toilet/Kamar Mandi'],
            ['nama_kategori' => 'Lapangan Olahraga'],
            ['nama_kategori' => 'Perpustakaan'],
            ['nama_kategori' => 'Kantin'],
            ['nama_kategori' => 'Mushola'],
            ['nama_kategori' => 'Halaman/Taman Sekolah'],
            ['nama_kategori' => 'Parkir Kendaraan'],
            ['nama_kategori' => 'Ruang Guru'],
            ['nama_kategori' => 'Listrik/Lampu'],
            ['nama_kategori' => 'Air/Sanitasi'],
            ['nama_kategori' => 'Pintu/Jendela'],
            ['nama_kategori' => 'Meja/Kursi'],
            ['nama_kategori' => 'Papan Tulis'],
            ['nama_kategori' => 'AC/Kipas Angin'],
            ['nama_kategori' => 'Proyektor/LCD'],
            ['nama_kategori' => 'Jaringan Internet/WiFi'],
            ['nama_kategori' => 'Keamanan Sekolah'],
            ['nama_kategori' => 'Lainnya'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
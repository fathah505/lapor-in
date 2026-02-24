<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'username' => 'admin',
            'email'    => 'admin@laporin.sch.id',
            'nis_nip'  => 'ADM001',
            'name'     => 'Admin Sekolah',
            'password' => Hash::make('admin123'),
            'telp'     => '081234567890',
            'level'    => 'admin',
        ]);

        User::create([
            'username' => 'admin2',
            'email'    => 'admin2@laporin.sch.id',
            'nis_nip'  => 'ADM002',
            'name'     => 'Budi Santoso',
            'password' => Hash::make('admin123'),
            'telp'     => '081234567891',
            'level'    => 'admin',
        ]);

        // SISWA Kelas X
        User::create([
            'nis_nip'  => '2024001',
            'name'     => 'Andi Pratama',
            'kelas'    => 'X-IPA-1',
            'email'    => 'andi.pratama@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678901',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2024002',
            'name'     => 'Bella Safira',
            'kelas'    => 'X-IPA-1',
            'email'    => 'bella.safira@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678902',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2024003',
            'name'     => 'Candra Wijaya',
            'kelas'    => 'X-IPA-2',
            'email'    => 'candra.wijaya@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678903',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2024004',
            'name'     => 'Dina Amelia',
            'kelas'    => 'X-IPA-2',
            'email'    => 'dina.amelia@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678904',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2024005',
            'name'     => 'Eko Prasetyo',
            'kelas'    => 'X-IPS-1',
            'email'    => 'eko.prasetyo@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678905',
            'level'    => 'siswa',
        ]);

        // SISWA Kelas XI
        User::create([
            'nis_nip'  => '2023001',
            'name'     => 'Fajar Ramadhan',
            'kelas'    => 'XI-IPA-1',
            'email'    => 'fajar.ramadhan@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678906',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2023002',
            'name'     => 'Gita Savitri',
            'kelas'    => 'XI-IPA-1',
            'email'    => 'gita.savitri@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678907',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2023003',
            'name'     => 'Hendra Gunawan',
            'kelas'    => 'XI-IPA-2',
            'email'    => 'hendra.gunawan@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678908',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2023004',
            'name'     => 'Indah Permata',
            'kelas'    => 'XI-IPS-1',
            'email'    => 'indah.permata@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678909',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2023005',
            'name'     => 'Joko Susilo',
            'kelas'    => 'XI-IPS-1',
            'email'    => 'joko.susilo@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678910',
            'level'    => 'siswa',
        ]);

        // SISWA Kelas XII
        User::create([
            'nis_nip'  => '2022001',
            'name'     => 'Kurnia Sari',
            'kelas'    => 'XII-IPA-1',
            'email'    => 'kurnia.sari@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678911',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2022002',
            'name'     => 'Lukman Hakim',
            'kelas'    => 'XII-IPA-1',
            'email'    => 'lukman.hakim@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678912',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2022003',
            'name'     => 'Maya Anggraini',
            'kelas'    => 'XII-IPA-2',
            'email'    => 'maya.anggraini@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678913',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2022004',
            'name'     => 'Nanda Rizky',
            'kelas'    => 'XII-IPS-1',
            'email'    => 'nanda.rizky@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678914',
            'level'    => 'siswa',
        ]);

        User::create([
            'nis_nip'  => '2022005',
            'name'     => 'Oki Setiawan',
            'kelas'    => 'XII-IPS-1',
            'email'    => 'oki.setiawan@student.sch.id',
            'password' => Hash::make('siswa123'),
            'telp'     => '081345678915',
            'level'    => 'siswa',
        ]);
    }
}
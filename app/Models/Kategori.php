<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kategori extends Model
{
    use HasFactory;
    // 1. Override Nama Tabel (Wajib karena tabel kita singular)
    protected $table = 'kategori';
    // 2. Mass Assignment (Agar bisa diisi langsung)
    protected $fillable = [
        'nama_kategori',
    ];
    // 3. RELASI (Opsional tapi berguna untuk Dashboard Admin)
    // Fungsi: Melihat ada berapa pengaduan di kategori ini?
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'id');
    }
}

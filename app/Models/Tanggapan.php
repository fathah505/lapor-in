<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = [
        'pengaduan_id',
        'admin_id',
        'tanggapan',
        'tgl_tanggapan'
    ];

    protected $casts = [
        'tgl_tanggapan' => 'datetime'
    ];

    /**
     * Relasi ke Pengaduan
     */
    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    /**
     * Relasi ke Admin (User dengan level admin)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_surat_masuk',
        'kategori_surat', 
        'tahun',
        'nomor_surat',
        'nama_kegiatan',
        'pengguna_id',
        'status',
        'dokumentasi',
        'file_surat',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}

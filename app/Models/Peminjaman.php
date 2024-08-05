<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'jumlah_pinjaman',
        'jangka_waktu',
        'tanggal_mulai',
        'tanggal_akhir',
    ];

    public function getBiayaAdminAttribute()
    {
        if ($this->jangka_waktu > 0) {
            $jumlahPinjaman = $this->jumlah_pinjaman;
            return ($jumlahPinjaman + ($jumlahPinjaman * 0.02)) / $this->jangka_waktu;
        }

        return 0;
    }

    public function fakturPeminjaman()
    {
        return $this->belongsTo(FakturPeminjaman::class, 'faktur_peminjaman_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'faktur_peminjaman_id',
        'jumlah_pinjaman',
        'tanggal_mulai',
        'tanggal_akhir',
    ];

    public function statusPembayaran(): bool
    {
        return $this->pembayaran ? true : false;
    }

    public function fakturPeminjaman()
    {
        return $this->belongsTo(FakturPeminjaman::class, 'faktur_peminjaman_id');
    }

    public function pembayaran(){
        return $this->hasOne(Pembayaran::class, 'peminjaman_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillabel = [
        'jumlah_pinjaman',
        'jangka_waktu',
        'alasan_peminjaman',
    ];
}

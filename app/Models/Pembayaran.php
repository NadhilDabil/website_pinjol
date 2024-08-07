<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'Pembayaran';

    protected $fillable = [
        'peminjaman_id',
        'bukti_pembayaran',
        'status_pembayaran',
    ];

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

}

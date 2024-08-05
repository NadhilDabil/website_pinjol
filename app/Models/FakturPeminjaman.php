<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FakturPeminjaman extends Model
{
    protected $table = 'faktur_peminjaman';

    protected $fillable = [
        'nasabah_id',
        'total_pinjaman',
        'biaya_admin',
        'tanggal_pencairan',
        'alasan_peminjaman',
        'jangka_waktu',
    ];

    public function nasabah() : BelongsTo
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function peminjaman() : HasMany
    {
        return $this->hasMany(Peminjaman::class, 'faktur_peminjaman_id');
    }
}

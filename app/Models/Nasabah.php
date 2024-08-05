<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nomor_telepon',
        'nomor_telepon_jaminan',
        'tempat_lahir',
        'tgl_lahir',
        'usia',
        'tanggal_pendaftaran',
        'jenis_kelamin',
        'pekerjaan',
        'nama_ibu',
        'no_rekening',
        'jenis_bank',
        'alamat',
        'foto_ktp',
        'nik',
        'verified'
    ];

    public function getFotoKtpUrlAttribute()
    {
        return Storage::url($this->foto_ktp);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('users');
    }

    public function fakturPeminjaman()
    {
        return $this->hasMany(FakturPeminjaman::class, 'nasabah_id');
    }

    public function peminjaman()
    {
        return $this->hasManyThrough(Peminjaman::class, FakturPeminjaman::class, 'nasabah_id', 'faktur_peminjaman_id');
    }
}

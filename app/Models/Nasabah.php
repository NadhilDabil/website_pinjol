<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'jenis_kelamin',
        'pekerjaan',
        'nama_ibu',
        'no_rekening',
        'alamat',
        'foto_ktp',
        'nik',
        'verified'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('users');
    }
}

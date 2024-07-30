<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nomor_telepon',
        'nomor_telepon_jaminan',
        'tempat_tgl_lahir',
        'usia',
        'jenis_kelamin',
        'pekerjaan',
        'nama_ibu',
        'no_rekening',
        'alamat',
        'foto_ktp',
        'nik',
    ];
}

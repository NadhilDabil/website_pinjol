<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_foto = storage_path('app/public/Image/');
        $destinationPath = public_path('storage/uploads/');

        $files = ['arashmil.jpg'];


        foreach ($files as $file) {
            copy($file_foto . $file, $destinationPath . $file);

            $tglLahir = '2001-01-01'; // Ganti dengan tanggal lahir yang sesuai
            $usia = Carbon::parse($tglLahir)->age;

            DB::table('nasabah')->insert([
                'user_id' => 1,
                'nik' => '1021021021021022',
                'nama_lengkap' => 'Nasabah Dummy',
                'alamat' => 'Jl. Menuju Tak Terbatas',
                'nomor_telepon' => '878800123',
                'nomor_telepon_jaminan' => '8718271823',
                'nama_ibu' => 'Eis',
                'tanggal_pendaftaran' => Carbon::now(),
                'foto_ktp' => 'storage/uploads/' . $file,
                'pekerjaan' => 'Cleaning Service',
                'usia' => $usia,
                'no_rekening' => '10210192391',
                'jenis_bank' => 'BCA',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => $tglLahir,
                'jenis_kelamin' => 'Pria',
                'verified' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nasabah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap', 255);
            $table->string('alamat', 255);
            $table->string('nomor_telepon', 20)->unique();
            $table->string('nomor_telepon_jaminan', 20);
            $table->string('nama_ibu', 225 );
            $table->date('tanggal_pendaftaran');
            $table->string('foto_ktp');
            $table->string('pekerjaan');
            $table->integer('usia');
            $table->string('no_rekening', 20);
            $table->string('jenis_bank');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->default('Pria');
            $table->boolean('verified')->default(false);
            $table->timestamps();

            #FOREIGN KEY
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah');
    }
};

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
        Schema::create('faktur_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nasabah_id');
            $table->double('total_pinjaman');
            $table->double('biaya_admin');
            $table->date('tanggal_pencairan')->nullable();
            $table->text('alasan_peminjaman');
            $table->integer('jangka_waktu');
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();

            #FOREIGH KEY
            $table->foreign('nasabah_id')->references('id')->on('nasabah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur_peminjaman');
    }
};

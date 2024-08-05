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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faktur_peminjaman_id');
            $table->double('jumlah_pinjaman');
            $table->double('suku_bunga')->default(0.3);
            $table->date('tanggal_akhir')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->timestamps();

            #FOREIGH KEY
            $table->foreign('faktur_peminjaman_id')->references('id')->on('faktur_peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};

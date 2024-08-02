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
            $table->unsignedBigInteger('nasabah_id');
            $table->double('jumlah_pinjaman');
            $table->date('jangka_waktu');
            $table->double('suku_bunga')->default(15);
            $table->date('tanggal_pencairan')->nullable();
            $table->text('alasan_peminjaman', 255);
            $table->enum('status', ['pending','approve'])->default('pending');
            // $table->enum('status_peminjaman', ['Lunas', 'Belum Lunas']);
            // $table->string('admin_id')->references('id')->on('admin')->onDelete('set null');
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
        Schema::dropIfExists('peminjaman');
    }
};

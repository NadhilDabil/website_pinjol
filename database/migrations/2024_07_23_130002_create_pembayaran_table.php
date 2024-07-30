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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id');
            $table->double('pembayaran');
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran', 30);
            $table->enum('status_pembayaran', ['Lunas', 'Pending']);
            // $table->string('admin_id')->references('admin_id')->on('admin')->onDelete('set null');
            $table->timestamps();

            #FOREIGN KEY
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

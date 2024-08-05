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
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->integer('jangka_waktu')->change();
            $table->date('tanggal_akhir')->nullable();
            $table->date('tanggal_mulai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->date('jangka_waktu')->change();
            $table->date('tanggal_akhir')->nullable();
            $table->dropColumn('tanggal_mulai');
        });
    }
};

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
            $table->text('alasan_peminjaman', 255)->after('tanggal_pencairan');
            $table->enum('status', ['pending','approve'])->after('alasan_peminjaman')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('alasan_peminjaman');
            $table->dropColumn('status');
        });
    }
};

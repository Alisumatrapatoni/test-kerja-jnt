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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barangs');

            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');

            $table->integer('jumlah_request');
            $table->enum('status_manager', ['PROSES', 'DITERIMA', 'DIAMBIL', 'DITOLAK', 'SELESAI'])->default('PROSES');
            $table->enum('status_hq', ['PROSES', 'DITERIMA', 'DIAMBIL', 'DITOLAK', 'SELESAI'])->default('PROSES');

            $table->text('keperluan')->nullable();
            $table->timestamps();
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

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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 100)->unique();
            $table->string('nama', 100);
            $table->integer('jumlah');
            $table->string('satuan', 100);
            $table->date('tanggal_pembelian');
            $table->bigInteger('nilai_harga');
            $table->string('brand', 100);
            $table->string('kondisi', 100);
            $table->string('gambar', 200);
            $table->enum('aktif', ['y', 't'])->default('y');
            $table->text('detail_tempat');
            $table->string('status_persetujuan_manager')->nullable();
            $table->string('status_persetujuan_hq')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};

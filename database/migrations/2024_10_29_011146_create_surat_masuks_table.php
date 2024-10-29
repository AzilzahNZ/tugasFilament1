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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_surat_masuk');
            $table->enum ('kategori_surat', ['Pengajuan Surat Izin Kegiatan', 'Pengajuan Proposal Dana']);
            $table->integer('tahun');
            $table->string('nomor_surat');
            $table->string('nama_kegiatan');
            $table->foreignId('pengguna_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->boolean('status');
            $table->binary('dokumentasi');
            $table->binary('file_surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};

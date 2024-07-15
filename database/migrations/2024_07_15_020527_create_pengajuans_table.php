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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengaju');
            $table->enum('status_pengajuan', ['DIAJUKAN', 'SELESAI', 'DITOLAK']);

            $table->foreignId('id_divisi')->constrained('divisis')->cascadeOnDelete();
            $table->string('judul_pengajuan');
            $table->unsignedInteger('nominal')->nullable();
            $table->foreignId('id_tipe_pengajuan')->constrained('tipe_pengajuans')->cascadeOnDelete();
            $table->foreignId('id_bank')->constrained('banks')->cascadeOnDelete();
            $table->integer('nomor_rekening')->nullable();
            $table->string('nama_pemilik_rekening')->nullable();
            $table->dateTime('check_in_time')->nullable();
            $table->string('image_lampiran_pengajuan')->nullable();
            $table->string('image_approval_pengajuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};

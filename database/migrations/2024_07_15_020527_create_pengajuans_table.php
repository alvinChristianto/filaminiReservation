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
            $table->enum('status_pengajuan', ['DIAJUKAN', 'DISETUJUI', 'DITOLAK', 'SELESAI']);

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->foreignId('divisi_id')->constrained('divisis')->cascadeOnDelete();
            $table->string('judul_pengajuan');
            $table->unsignedInteger('nominal')->nullable();
            $table->foreignId('tipe_pengajuan_id')->constrained('tipe_pengajuans')->cascadeOnDelete();
            $table->foreignId('bank_id')->constrained('banks')->cascadeOnDelete();
            $table->string('nomor_rekening')->nullable();
            $table->string('nama_pemilik_rekening')->nullable();
            $table->dateTime('tanggal_akhir_bayar')->nullable();
            $table->text('notes_pengajuan')->nullable();
            $table->string('image_lampiran_pengajuan')->nullable();
            $table->string('image_lampiran_approval')->nullable();
            $table->string('image_lampiran_pembelanjaan')->nullable();
            $table->dateTime('tanggal_approval')->nullable();
            $table->dateTime('tanggal_pembelanjaan')->nullable();
            $table->text('notes_approval')->nullable();
            $table->text('notes_pembelanjaan')->nullable();
            
            $table->foreignId('last_edited_by_id')->constrained('users')->cascadeOnDelete()->nullable();
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

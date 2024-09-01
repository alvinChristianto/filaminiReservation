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
        Schema::create('laporan_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pekerjaan')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('divisi_id')->constrained('divisis')->cascadeOnDelete();
            $table->dateTime('jam_mulai')->nullable();
            $table->dateTime('jam_selesai')->nullable();
            $table->text('deskripsi_masalah')->nullable();
            $table->text('deskripsi_penyelesaian')->nullable();
            $table->string('image_sebelum_pekerjaan')->nullable();
            $table->string('image_setelah_pekerjaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kerjas');
    }
};

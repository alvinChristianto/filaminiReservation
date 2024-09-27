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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp')->nullable();
            $table->foreignId('keluarga_id')->constrained('keluargas')->cascadeOnDelete();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->string('place_birth');
            $table->dateTime('date_birth');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->enum('rt', ['1', '2', '3', '4']);
            $table->enum('rw', ['1', '2']);
            $table->enum('working_status', ['Belum Bekerja', 'Petani','Wirausaha','Sekolah', 'Mahasiswa', 'Pegawai Negeri', 'Pegawai Swasta', 'Pensiunan']);
            $table->enum('marriage_status', ['Lajang', 'Menikah','Cerai Mati','Cerai Hidup', 'Belum Diketahui']);
            $table->string('image_penduduk')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};

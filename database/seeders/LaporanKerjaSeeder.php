<?php

namespace Database\Seeders;

use App\Models\LaporanKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LaporanKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/laporankerja.json");
        $laporan = json_decode($json);

        foreach ($laporan as $key => $value) {
            LaporanKerja::create([
                "judul_pekerjaan" => $value->judul_pekerjaan,
                "divisi_id" => $value->divisi_id,
                "jam_mulai" => $value->jam_mulai,
                "jam_selesai" => $value->jam_selesai,
                "deskripsi_masalah" => $value->deskripsi_masalah,
                "deskripsi_penyelesaian" => $value->deskripsi_penyelesaian
            ]);
        }
    }
}

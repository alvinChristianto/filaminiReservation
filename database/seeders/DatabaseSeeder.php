<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Divisi;
use App\Models\Room;
use App\Models\RoomService;
use App\Models\TipePengajuan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Room::factory()->create([
            'name' => 'Deluxe Room',
            'quantity' => 2,
            'description' => 'lorem ipsum',
            'status' => 'active',
        ]);

        Room::factory()->create([
            'name' => 'Standart Room',
            'quantity' => 2,
            'description' => 'lorem ipsum',
            'status' => 'active',
        ]);

        RoomService::factory()->create([
            'name_service' => 'Air Mineral',
            'type' => 'free',
            'description' => 'lorem ipsum',
        ]);

        Divisi::factory()->create([
            'nama' => 'Head Office',
            'tipe' => 'HO',
        ]);
        Divisi::factory()->create([
            'nama' => 'Finance',
            'tipe' => 'HO',
        ]);
        Divisi::factory()->create([
            'nama' => 'The Cabin Hotel Sutomo',
            'tipe' => 'HOTEL',
        ]);
        Divisi::factory()->create([
            'nama' => 'The Cabin Hotel Gandekan',
            'tipe' => 'HOTEL',
        ]);

        TipePengajuan::factory()->create([
            'nama_tipe' => 'RAB',
        ]);
        TipePengajuan::factory()->create([
            'nama_tipe' => 'Non RAB',
        ]);

        Bank::factory()->create([
            'nama_bank' => 'MANDIRI',
        ]);
        Bank::factory()->create([
            'nama_bank' => 'BCA',
        ]);
    }
}

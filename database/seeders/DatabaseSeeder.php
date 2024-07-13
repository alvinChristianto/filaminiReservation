<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomService;
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
            'status' => 'active' ,
        ]);

        Room::factory()->create([
            'name' => 'Standart Room',
            'quantity' => 2,
            'description' => 'lorem ipsum',
            'status' => 'active' ,
        ]);

        RoomService::factory()->create([
            'name_service' => 'Air Mineral',
            'type' => 'free',
            'description' => 'lorem ipsum',
        ]);

       
    }
}

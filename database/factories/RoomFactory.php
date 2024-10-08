<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    
    {
        return [
            'name' => $this->faker->name(),
            'quantity' => $this->faker->numberBetween(2,10),
            'description' => $this->faker->paragraph(1),
            'status' => 'active'
        ];
    }
    
}

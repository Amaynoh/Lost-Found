<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Objets>
 */
class ObjetsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['perdu', 'trouvé']),
            'location' => $this->faker->city(),
            'date' => $this->faker->date(),
            'image' => null,
            'status' => 'en attente',
            'user_id' => User::factory(), 
        ];
    }
}

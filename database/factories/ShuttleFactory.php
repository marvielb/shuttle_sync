<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shuttle>
 */
class ShuttleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shuttle_driver_id' => User::factory()->create(),
            'shuttle_model_name' => $this->faker->word(),
            'shuttle_plate_number' => strtoupper($this->faker->randomLetter.$this->faker->randomLetter.$this->faker->randomLetter)
                                         .'-'.
                                        $this->faker->randomDigitNotNull().$this->faker->randomDigitNotNull().$this->faker->randomDigitNotNull(),
            'shuttle_capacity' => $this->faker->randomElement([3, 8, 12]),
        ];
    }
}

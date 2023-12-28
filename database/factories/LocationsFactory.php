<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locations>
 */
class LocationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locationName = $this->faker->city;
        $abbreviation = $this->generateAbbreviation($locationName);

        return [
            'location_name' => $locationName,
            'location_abbreviation' => $abbreviation,
        ];
    }

    /**
     * @param  string  $locationName
     */
    private function generateAbbreviation($locationName): string
    {
        $words = explode(' ', $locationName);
        $abbreviation = '';

        foreach ($words as $word) {
            $abbreviation .= strtoupper($word[0]);
        }

        return $abbreviation;
    }
}

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
        $shuttles = [
            [
                'shuttle_model_name' => 'Toyota Hiace',
                'shuttle_capacity' => 12,
                'image_url' => 'https://toyotasantarosa.com.ph/wp-content/uploads/2021/10/Hiace_adobespark.png',
            ],
            [
                'shuttle_model_name' => 'Ford Transit',
                'shuttle_capacity' => 15,
                'image_url' => 'https://www.ford.co.uk/content/dam/guxeu/rhd/central/cvs/2018-transit-custom/bodystyles/ford-transit_custom-uk-MCA-16x9-768x432-van-hero-white.png.renditions.extra-large_668x376.png.renditions.original.png',
            ],
            [
                'shuttle_model_name' => 'Mercedes-Benz Sprinter',
                'shuttle_capacity' => 10,
                'image_url' => 'https://platform.cstatic-images.com/xlarge/in/v2/stock_photos/dda49068-9f79-48a9-aa8a-0483daa8ecfc/60a9d9cd-c515-4648-8064-74bea08d04e7.png',
            ],
            [
                'shuttle_model_name' => 'Nissan NV350 Urvan',
                'shuttle_capacity' => 14,
                'image_url' => 'https://www.nicepng.com/png/full/322-3220678_passenger-cargo-van-nissan-urvan-nv350-18-seater.png',
            ],
            [
                'shuttle_model_name' => 'Mitsubishi L300',
                'shuttle_capacity' => 10,
                'image_url' => 'https://mitsubishibybunny.weebly.com/uploads/8/4/3/7/84370188/published/2015-mitsubishi-l300-car.png?1486537875',
            ],
        ];

        $shuttle = $this->faker->randomElement($shuttles);

        return [
            'shuttle_driver_id' => User::factory()->create(),
            'shuttle_model_name' => $shuttle['shuttle_model_name'],
            'shuttle_plate_number' => strtoupper($this->faker->randomLetter.$this->faker->randomLetter.$this->faker->randomLetter)
                                         .'-'.
                                        $this->faker->randomDigitNotNull().$this->faker->randomDigitNotNull().$this->faker->randomDigitNotNull(),
            'shuttle_capacity' => $shuttle['shuttle_capacity'],
            'image_url' => $shuttle['image_url'],
        ];
    }
}

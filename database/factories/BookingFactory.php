<?php

namespace Database\Factories;

use App\Models\ShuttleSchedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_user_id' => User::factory(),
            'booking_shuttle_schedule_id' => ShuttleSchedule::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Shuttle;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShuttleSchedule>
 */
class ShuttleScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shuttle_id' => Shuttle::factory(),
            'time_slot_id' => TimeSlot::factory(),
            'from_location_id' => Location::factory(),
            'to_location_id' => Location::factory(),
            'date' => Carbon::now(),
        ];
    }
}

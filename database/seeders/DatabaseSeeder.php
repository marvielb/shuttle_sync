<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Booking;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    use WithFaker;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->setUpFaker();
        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'john@example.com',
        ]);

        $hours = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
        collect($hours)->each(function ($number) {
            \App\Models\TimeSlot::factory()->create([
                'start_time' => Carbon::createFromTime($number),
                'end_time' => Carbon::createFromTime($number, 30),
            ]);
            \App\Models\TimeSlot::factory()->create([
                'start_time' => Carbon::createFromTime($number, 30),
                'end_time' => Carbon::createFromTime($number + 1),
            ]);
        });

        $locations = collect([
            ['name' => 'Manila', 'abbreviation' => 'MNL'],
            ['name' => 'Quezon City', 'abbreviation' => 'QC'],
            ['name' => 'Makati City', 'abbreviation' => 'MKA'],
            ['name' => 'Taguig City', 'abbreviation' => 'TAG'],
            ['name' => 'Pasig City', 'abbreviation' => 'PSG'],
        ])->map(function ($location) {
            return \App\Models\Location::factory()->create($location);
        });

        $shuttles = \App\Models\Shuttle::factory()->count(50)->create();

        $locationIds = $locations->map(fn ($location) => $location['id']);
        $possibleRoutes = collect(Arr::crossJoin($locationIds, $locationIds))
            ->filter(fn ($route) => $route[0] != $route[1])
            ->values();

        $shuttles->each(function ($shuttle, $index) use ($possibleRoutes) {
            $timeslots = TimeSlot::all();
            $timeslots->each(function ($timeslot, $timeslotIndex) use ($index, $shuttle, $possibleRoutes) {
                $routeIndex = $index % count($possibleRoutes);
                $schedule = ShuttleSchedule::factory()->create([
                    'shuttle_id' => $shuttle['id'],
                    'time_slot_id' => $timeslot['id'],
                    'from_location_id' => $possibleRoutes[$routeIndex][0],
                    'to_location_id' => $possibleRoutes[$routeIndex][1],
                ]);
                $randomBookings = $this->faker->randomElement(range(0, $shuttle['capacity']));
                Booking::factory()->count($randomBookings)->create([
                    'shuttle_schedule_id' => $schedule['id'],
                ]);
            });
        });

        $schedule = \App\Models\ShuttleSchedule::first();

        \App\Models\Booking::factory()->create([
            'user_id' => $user,
            'shuttle_schedule_id' => $schedule,
        ]);
    }
}

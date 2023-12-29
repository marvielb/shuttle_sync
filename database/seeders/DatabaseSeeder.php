<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
            ['name' => 'Mandaluyong City', 'abbreviation' => 'MND'],
            ['name' => 'San Juan City', 'abbreviation' => 'SJN'],
            ['name' => 'Pasay City', 'abbreviation' => 'PAS'],
            ['name' => 'Parañaque City', 'abbreviation' => 'PQA'],
            ['name' => 'Valenzuela City', 'abbreviation' => 'VLN'],
        ])->map(function ($location) {
            return \App\Models\Location::factory()->create($location);
        });

        $shuttles = \App\Models\Shuttle::factory()->count(10)->create();

        $shuttles->each(function ($shuttle, $index) use ($locations) {
            $timeslots = TimeSlot::all();
            $timeslots->each(function ($timeslot, $timeslotIndex) use ($index, $locations, $shuttle) {
                $primaryIndex = ($index + ($timeslotIndex % 2)) % count($locations);
                $secondaryIndex = (($index) + (($timeslotIndex + 1) % 2)) % count($locations);
                ShuttleSchedule::factory()->create([
                    'shuttle_id' => $shuttle['id'],
                    'time_slot_id' => $timeslot['id'],
                    'from_location_id' => $locations[$primaryIndex]['id'],
                    'to_location_id' => $locations[$secondaryIndex]['id'],
                ]);
            });
        });

        $schedule = \App\Models\ShuttleSchedule::first();

        \App\Models\Booking::factory()->create([
            'booking_user_id' => $user,
            'booking_shuttle_schedule_id' => $schedule,
        ]);
    }
}

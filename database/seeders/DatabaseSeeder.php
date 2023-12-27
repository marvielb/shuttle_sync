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

        $hours = [8,9,10,11,12,13,14,15,16,17];
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
           ['location_name' => 'Manila', 'location_abbreviation' => 'MNL'],
           ['location_name' => 'Quezon City', 'location_abbreviation' => 'QC'],
           ['location_name' => 'Makati City', 'location_abbreviation' => 'MKA'],
           ['location_name' => 'Taguig City', 'location_abbreviation' => 'TAG'],
           ['location_name' => 'Pasig City', 'location_abbreviation' => 'PSG'],
           ['location_name' => 'Mandaluyong City', 'location_abbreviation' => 'MND'],
           ['location_name' => 'San Juan City', 'location_abbreviation' => 'SJN'],
           ['location_name' => 'Pasay City', 'location_abbreviation' => 'PAS'],
           ['location_name' => 'Parañaque City', 'location_abbreviation' => 'PQA'],
           ['location_name' => 'Valenzuela City', 'location_abbreviation' => 'VLN'],
       ])->map(function ($location) {
           return \App\Models\Location::factory()->create($location);
       });

        $shuttles = \App\Models\Shuttle::factory()->count(10)->create();

        $shuttles->each(function ($shuttle, $index) use ($hours, $locations) {
            $timeslots = TimeSlot::all();
            $timeslots->each(function ($timeslot, $timeslotIndex) use ($index, $locations, $shuttle) {
                $primaryIndex = ($index + ($timeslotIndex % 2)) % count($locations);
                $secondaryIndex = (($index) + (($timeslotIndex + 1) % 2)) % count($locations);
                ShuttleSchedule::factory()->create([
                    'shuttle_id' => $shuttle['shuttle_id'],
                    'time_slot_id' => $timeslot['time_slot_id'],
                    'from_location_id' => $locations[$primaryIndex]['location_id'],
                    'to_location_id' => $locations[$secondaryIndex]['location_id'],
                ]);
            });
        });

        $schedule = \App\Models\ShuttleSchedule::first();

        \App\Models\Booking::factory()->create([
            'booking_user_id' => $user,
            'booking_shuttle_schedule_id' => $schedule
        ]);
    }
}

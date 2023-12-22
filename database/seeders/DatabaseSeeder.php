<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'john@example.com',
        ]);

        collect([8,9,10,11,12,13,14,15,16,17])->each(function ($number) {
            \App\Models\TimeSlot::factory()->create([
                'start_time' => Carbon::createFromTime($number),
                'end_time' => Carbon::createFromTime($number, 30),
            ]);
            \App\Models\TimeSlot::factory()->create([
                'start_time' => Carbon::createFromTime($number, 30),
                'end_time' => Carbon::createFromTime($number + 1),
            ]);
        });

        $locations = [
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
       ];

        foreach ($locations as $location) {
            \App\Models\Location::create($location);
        }

        \App\Models\Shuttle::factory()->count(10)->create();
    }
}

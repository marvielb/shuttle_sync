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

    }
}

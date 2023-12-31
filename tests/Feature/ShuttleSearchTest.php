<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShuttleSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_must_see_locations_and_timeslots(): void
    {
        $user = User::factory()->create();
        $locations = Location::factory()->count(2)->create();
        $timeslots = TimeSlot::factory()->count(2)->create();
        $response = $this
            ->actingAs($user)
            ->get('/shuttles/search');

        $locations->each(function ($location) use ($response) {
            $response->assertSeeText($location['name']);
        });

        $timeslots->each(function ($timeslot) use ($response) {
            $response->assertSeeText($timeslot['formatted_start_time']);
        });

        $response->assertStatus(200);
    }

    public function test_must_be_redirected_to_if_have_errors(): void
    {

        $user = User::factory()->create();
        $locations = Location::factory()->count(1)->create();
        $timeslots = TimeSlot::factory()->count(1)->create();
        $response = $this
            ->actingAs($user)
            ->post('/shuttles/search', [
                'from_location_id' => $locations[0]['id'],
                'to_location_id' => $locations[0]['id'],
                'time_slot_id' => $timeslots[0]['id'],
            ]);

        $response->assertSessionHasErrors();
    }

    public function test_must_show_all_of_the_available_shuttles(): void
    {
        $user = User::factory()->create();
        $schedule = ShuttleSchedule::factory()->create();
        $schedule->load('shuttle.driver');

        $response = $this->actingAs($user)
            ->post('/shuttles/search', [
                'from_location_id' => $schedule['from_location_id'],
                'to_location_id' => $schedule['to_location_id'],
                'time_slot_id' => $schedule['time_slot_id'],
            ]);

        $response->assertSeeText($schedule->shuttle->driver->name);
        $response->assertSeeText($schedule->shuttle->model_name);
    }

    public function test_must_show_only_for_today_schedule(): void
    {
        $user = User::factory()->create();
        $schedule = ShuttleSchedule::factory()->create(
            ['date' => Carbon::now()]
        );
        $scheduleYesterday = ShuttleSchedule::factory()->create([
            'date' => Carbon::now()->subDay(1),
            'from_location_id' => $schedule->from_location_id,
            'to_location_id' => $schedule->to_location_id,
            'time_slot_id' => $schedule->time_slot_id,
        ]);
        $scheduleTomorrow = ShuttleSchedule::factory()->create([
            'date' => Carbon::now()->addDay(1),
            'from_location_id' => $schedule->from_location_id,
            'to_location_id' => $schedule->to_location_id,
            'time_slot_id' => $schedule->time_slot_id,
        ]);

        $response = $this->actingAs($user)
            ->post('/shuttles/search', [
                'from_location_id' => $schedule['from_location_id'],
                'to_location_id' => $schedule['to_location_id'],
                'time_slot_id' => $schedule['time_slot_id'],
            ]);

        $response->assertSeeText($schedule->shuttle->plate_number);
        $response->assertDontSeeText($scheduleTomorrow->shuttle->plate_number);
        $response->assertDontSeeText($scheduleYesterday->shuttle->plate_number);
    }
}

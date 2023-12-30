<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\ShuttleSchedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_must_see_the_booking_info(): void
    {
        $user = User::factory()->createOne();
        $schedule = ShuttleSchedule::factory()->createOne();
        $schedule->load(['shuttle.driver', 'timeSlot']);
        $response = $this->actingAs($user)
            ->get("/booking/{$schedule->id}/confirmation");

        $response->assertSeeText($schedule->shuttle->model_name);
        $response->assertSeeText($schedule->timeSlot->formatted_start_time);

        $response->assertStatus(200);
    }

    public function test_must_return_404_if_not_exists(): void
    {
        $user = User::factory()->createOne();
        $shuttle = ShuttleSchedule::factory()->createOne();
        $response = $this->actingAs($user)->get('/booking/123/confirmation');
        $response->assertStatus(404);
    }

    public function test_can_book(): void
    {

        $user = User::factory()->createOne();
        $schedule = ShuttleSchedule::factory()->createOne();
        $response = $this->actingAs($user)->post("/booking/{$schedule->id}/confirmation");

        $response->assertStatus(200);

        $response = $this->actingAs($user)->post('/shuttles/search', [
            'from_location_id' => $schedule->from_location_id,
            'to_location_id' => $schedule->to_location_id,
            'time_slot_id' => $schedule->time_slot_id,
        ]);

        $response->assertSeeText($schedule->shuttle->plate_number);
        $slotsAvailable = $schedule->shuttle->capacity - 1;
        $response->assertSeeText("{$slotsAvailable} Slots Available");
    }

    public function test_must_return_error_if_already_boooked(): void
    {
        $booking = Booking::factory()->createOne();
        $user = $booking->user;
        $schedule = $booking->shuttle_schedule;

        $response = $this->actingAs($user)
            ->post("/booking/{$schedule->id}/confirmation");

        $response->assertStatus(409);
    }
}

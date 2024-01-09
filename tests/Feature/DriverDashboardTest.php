<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriverDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_must_see_bookings(): void
    {
        $booking = Booking::factory()->create();
        $schedule = $booking->shuttleSchedule;
        $driver = $booking->shuttleSchedule->shuttle->driver;
        $timeSlot = $booking->shuttleSchedule->timeSlot;
        $response = $this->actingAs($driver)
            ->get('/driver/dashboard');
        $response->assertSeeText($timeSlot->formatted_start_time);
        $response->assertSeeText("{$schedule->fromLocation->abbreviation} - {$schedule->toLocation->abbreviation}");
        $response->assertSeeText("{$schedule->bookings_count} passengers");

        $response->assertStatus(200);
    }

    public function test_drivers_can_arrive_shuttle_schedule(): void
    {
        $booking = Booking::factory()->create();
        $schedule = $booking->shuttleSchedule;
        $driver = $schedule->shuttle->driver;
        $timeSlot = $schedule->timeSlot;

        $response = $this->actingAs($driver)
            ->post("/shuttles/{$schedule->id}/arrive");

        $response->assertRedirectToRoute('driver.dashboard');
    }

    public function test_users_cannot_arrive_shuttle_schedule(): void
    {
        $booking = Booking::factory()->create();
        $schedule = $booking->shuttleSchedule;
        $user = $booking->user;
        $response = $this->actingAs($user)
            ->post("/shuttles/{$schedule->id}/arrive");

        $response->assertStatus(403);
    }
}

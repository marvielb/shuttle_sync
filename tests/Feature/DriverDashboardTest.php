<?php

namespace Tests\Feature;

use App\Models\Booking;
use Tests\TestCase;

class DriverDashboardTest extends TestCase
{
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
}

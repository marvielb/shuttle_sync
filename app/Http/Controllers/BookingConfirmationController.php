<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ShuttleSchedule;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookingConfirmationController extends Controller
{
    public function create(int $shuttleScheduleId): View
    {
        $schedule = ShuttleSchedule::whereShuttleScheduleId($shuttleScheduleId)
            ->with(['shuttle.driver', 'timeSlot'])
            ->first();

        return view('booking.confirmation', compact('schedule'));
    }

    public function store(int $shuttleScheduleId, Request $request): View|Factory
    {
        $userId = $request->user()->id;

        $booking = Booking::create([
            'booking_user_id' => $userId,
            'booking_shuttle_schedule_id' => $shuttleScheduleId,
        ]);

        if (! $booking) {
            abort(404);
        }

        return view('booking.result');
    }
}

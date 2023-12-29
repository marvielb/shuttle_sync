<?php

namespace App\Http\Controllers;

use App\Models\ShuttleSchedule;
use Illuminate\View\View;

class BookingConfirmationController extends Controller
{
    public function create(int $shuttleScheduleId): View
    {
        $schedule = ShuttleSchedule::whereShuttleScheduleId($shuttleScheduleId)
            ->with(['shuttle.driver', 'timeSlot'])
            ->first();

        return view('booking.confirmation', compact('schedule'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShuttleSearchRequest;
use App\Models\Location;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class ShuttleSearchController extends Controller
{
    public function index(): View
    {
        $locations = Location::all();
        $timeSlots = TimeSlot::all();

        return view('shuttles.search', compact('locations', 'timeSlots'));
    }

    public function search(ShuttleSearchRequest $request): View
    {
        $user = $request->user();
        $formData = $request->validated();
        $schedules = ShuttleSchedule::whereToLocationId($formData['to_location_id'])
            ->whereFromLocationId($formData['from_location_id'])
            ->whereTimeSlotId($formData['time_slot_id'])
            ->whereDate('date', Carbon::now())
            ->with(['shuttle.driver', 'bookings'])
            ->get();

        return view('shuttles.result', compact('schedules', 'user'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShuttleSearchRequest;
use App\Models\Location;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ShuttleSearchController extends Controller
{
    public function index(): View|Factory
    {
        $locations = Location::all();
        $timeSlots = TimeSlot::all()->map(function ($timeSlot) {
            return [
                'time_slot_id' => $timeSlot['time_slot_id'],
                'start_time' => Carbon::parse($timeSlot['start_time'])->format('h:i A'),
            ];
        });

        return view('shuttles.search', compact('locations', 'timeSlots'));
    }

    public function search(ShuttleSearchRequest $request): View|Factory
    {
        $formData = $request->validated();
        $schedules = ShuttleSchedule::whereToLocationId($formData['to_location_id'])
            ->whereFromLocationId($formData['from_location_id'])
            ->whereTimeSlotId($formData['time_slot_id'])
            ->with(['shuttle'])
            ->get();

        return view('shuttles.result', compact('schedules'));
    }
}

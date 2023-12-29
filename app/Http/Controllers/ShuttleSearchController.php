<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShuttleSearchRequest;
use App\Models\Location;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

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
        $formData = $request->validated();
        $schedules = ShuttleSchedule::whereToLocationId($formData['to_location_id'])
            ->whereFromLocationId($formData['from_location_id'])
            ->whereTimeSlotId($formData['time_slot_id'])
            ->join('shuttles', 'shuttle_schedules.shuttle_id', '=', 'shuttles.id')
            ->join('users', 'shuttles.driver_id', '=', 'users.id')
            ->get([
                'shuttles.model_name',
                'shuttles.plate_number',
                'shuttle_schedules.id',
                'shuttles.image_url as shuttle_image_url',
                'users.name AS driver_name',
                DB::raw('(SELECT (shuttles.capacity -
                                    (SELECT COUNT(*) FROM
                                    bookings WHERE booking_shuttle_schedule_id = shuttle_schedules.id))
                            AS available_slots)')]);

        return view('shuttles.result', compact('schedules'));
    }
}

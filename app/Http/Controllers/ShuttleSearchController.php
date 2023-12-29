<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShuttleSearchRequest;
use App\Models\Location;
use App\Models\ShuttleSchedule;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

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
            ->join('shuttles', 'shuttle_schedules.shuttle_id', '=', 'shuttles.shuttle_id')
            ->join('users', 'shuttles.shuttle_driver_id', '=', 'users.id')
            ->get([
                'shuttles.shuttle_model_name',
                'shuttles.shuttle_plate_number',
                'shuttles.image_url as shuttle_image_url',
                'users.name AS driver_name',
                DB::raw('(SELECT (shuttles.shuttle_capacity -
                                    (SELECT COUNT(*) FROM
                                    bookings WHERE booking_shuttle_schedule_id = shuttle_schedules.shuttle_schedule_id))
                            AS available_slots)')]);

        return view('shuttles.result', compact('schedules'));
    }
}

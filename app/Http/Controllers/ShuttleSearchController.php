<?php

namespace App\Http\Controllers;

use App\Models\Location;
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
}

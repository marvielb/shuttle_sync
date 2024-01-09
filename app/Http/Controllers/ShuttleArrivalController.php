<?php

namespace App\Http\Controllers;

use App\Models\ShuttleSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShuttleArrivalController extends Controller
{
    public function store(Request $request, int $shuttleScheduleId): RedirectResponse
    {
        $schedule = ShuttleSchedule::whereId($shuttleScheduleId)
            ->with(['shuttle'])
            ->first();

        if ($request->user()->cannot('arrive', $schedule)) {
            abort(403);
        }

        $schedule->status = 'arrived';
        $result = $schedule->save();

        if ($result) {
            return redirect()->route('driver.dashboard');
        }

        abort(500);
    }
}

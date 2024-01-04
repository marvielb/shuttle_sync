<?php

namespace App\Http\Controllers;

use App\Models\Shuttle;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DriverDashboardController extends Controller
{
    public function index(Request $request): View|Factory
    {
        $user = $request->user();
        $driverShuttle = Shuttle::whereDriverId($user->id)
            ->with(['schedules' => function ($q) {
                $q->whereDate('shuttle_schedules.date', Carbon::now());
                $q->withCount('bookings');
            },
                'schedules.timeSlot',
                'schedules.fromLocation',
                'schedules.toLocation'])
            ->first();

        return view('driver.dashboard', ['schedules' => $driverShuttle->schedules]);
    }
}

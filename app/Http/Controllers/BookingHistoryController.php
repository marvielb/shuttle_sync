<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingHistoryController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $bookings = Booking::whereUserId($user->id)->with([
            'shuttleSchedule.shuttle',
            'shuttleSchedule.timeSlot',
        ])->orderBy('created_at', 'desc')->get();

        return view('booking.history', compact('bookings'));
    }
}

<?php

namespace App\Policies;

use App\Models\ShuttleSchedule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShuttleSchedulePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function arrive(User $user, ShuttleSchedule $schedule): Response
    {
        return $user->id === $schedule->shuttle->driver_id
                ? Response::allow() : Response::denyWithStatus(403);
    }
}

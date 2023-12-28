<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperShuttleSchedule
 */
class ShuttleSchedule extends Model
{
    use HasFactory;

    protected $table = 'shuttle_schedules';

    protected $primaryKey = 'shuttle_schedule_id';
}

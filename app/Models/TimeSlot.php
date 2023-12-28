<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperTimeSlot
 */
class TimeSlot extends Model
{
    use HasFactory;

    protected $table = 'time_slots';
    protected $primaryKey = 'time_slot_id';
}

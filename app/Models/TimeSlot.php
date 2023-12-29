<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getFormattedStartTimeAttribute(): string
    {
        return Carbon::parse($this->attributes['start_time'])->format('h:i A');
    }
}

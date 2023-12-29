<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperShuttleSchedule
 */
class ShuttleSchedule extends Model
{
    use HasFactory;

    protected $table = 'shuttle_schedules';

    protected $primaryKey = 'id';

    public function shuttle(): BelongsTo
    {
        return $this->belongsTo(Shuttle::class, 'shuttle_id');
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id');
    }

    public function fromLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'from_location_id');
    }

    public function toLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'to_location_id');
    }
}

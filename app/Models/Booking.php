<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperBooking
 */
class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'shuttle_schedule_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shuttleSchedule(): BelongsTo
    {
        return $this->belongsTo(ShuttleSchedule::class, 'shuttle_schedule_id');
    }
}

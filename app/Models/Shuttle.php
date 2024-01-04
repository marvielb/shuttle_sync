<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperShuttle
 */
class Shuttle extends Model
{
    use HasFactory;

    protected $table = 'shuttles';

    protected $primaryKey = 'id';

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(ShuttleSchedule::class, 'shuttle_id');
    }
}

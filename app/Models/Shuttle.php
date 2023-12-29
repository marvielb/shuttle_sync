<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperShuttle
 */
class Shuttle extends Model
{
    use HasFactory;

    protected $table = 'shuttles';

    protected $primaryKey = 'shuttle_id';

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shuttle_driver_id');
    }
}

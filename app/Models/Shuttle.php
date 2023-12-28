<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperShuttle
 */
class Shuttle extends Model
{
    use HasFactory;

    protected $table = 'shuttles';

    protected $primaryKey = 'shuttle_id';
}

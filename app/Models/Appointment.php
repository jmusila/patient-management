<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const DEFAULT_RELATIONS = ['user', 'notes'];

    public function notes(): HasMany
    {
        return $this->hasMany(AppointmentNote::class, 'appointment_id', 'id');
    }
}

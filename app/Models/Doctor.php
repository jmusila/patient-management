<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public const DEFAULT_RELATIONS = ['user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

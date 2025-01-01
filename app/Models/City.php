<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    //

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectType extends Model
{
    //

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class);
    }
}

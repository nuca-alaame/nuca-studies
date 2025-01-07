<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Operation extends Model
{
    //

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function projectTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            related: ProjectType::class,
            table: 'operation_project_types',
            foreignPivotKey: 'operation_id',
            relatedPivotKey: 'type_id')
            ->using(OperationProjectType::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(OperationType::class);
    }

    public function items()
    {
        return $this->hasMany(OperationItem::class);
    }
}

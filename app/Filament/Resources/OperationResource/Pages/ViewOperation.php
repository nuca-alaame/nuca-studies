<?php

namespace App\Filament\Resources\OperationResource\Pages;

use App\Filament\Resources\OperationResource;
use App\HasParentResource;
use Filament\Resources\Pages\ViewRecord;

class ViewOperation extends ViewRecord
{
    use HasParentResource;

    protected static string $resource = OperationResource::class;

    //    protected function getRedirectUrl(): string
    //    {
    //        return static::getParentResource()::getUrl('operations.index', [
    //            'parent' => $this->parent,
    //        ]);
    //    }

}

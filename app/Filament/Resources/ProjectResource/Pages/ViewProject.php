<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    //    protected function getRedirectUrl(): string
    //    {
    //        return static::getParentResource()::getUrl('operations.index', [
    //            'parent' => $this->parent,
    //        ]);
    //    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

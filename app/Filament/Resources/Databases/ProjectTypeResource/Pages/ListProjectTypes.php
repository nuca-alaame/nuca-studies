<?php

namespace App\Filament\Resources\Databases\ProjectTypeResource\Pages;

use App\Filament\Resources\Databases\ProjectTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectTypes extends ListRecords
{
    protected static string $resource = ProjectTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

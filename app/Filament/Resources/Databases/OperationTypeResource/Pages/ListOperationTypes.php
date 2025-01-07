<?php

namespace App\Filament\Resources\Databases\OperationTypeResource\Pages;

use App\Filament\Resources\Databases\OperationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOperationTypes extends ListRecords
{
    protected static string $resource = OperationTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

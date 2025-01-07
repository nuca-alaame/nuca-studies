<?php

namespace App\Filament\Resources\Databases\OperationTypeResource\Pages;

use App\Filament\Resources\Databases\OperationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOperationType extends CreateRecord
{
    protected static string $resource = OperationTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

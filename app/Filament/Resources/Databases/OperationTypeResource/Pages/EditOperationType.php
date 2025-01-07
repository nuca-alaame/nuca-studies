<?php

namespace App\Filament\Resources\Databases\OperationTypeResource\Pages;

use App\Filament\Resources\Databases\OperationTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOperationType extends EditRecord
{
    protected static string $resource = OperationTypeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

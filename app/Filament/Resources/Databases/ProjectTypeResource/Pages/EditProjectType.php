<?php

namespace App\Filament\Resources\Databases\ProjectTypeResource\Pages;

use App\Filament\Resources\Databases\ProjectTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectType extends EditRecord
{
    protected static string $resource = ProjectTypeResource::class;

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

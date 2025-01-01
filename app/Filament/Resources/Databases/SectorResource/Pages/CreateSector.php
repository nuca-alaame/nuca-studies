<?php

namespace App\Filament\Resources\Databases\SectorResource\Pages;

use App\Filament\Resources\Databases\SectorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSector extends CreateRecord
{
    protected static string $resource = SectorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

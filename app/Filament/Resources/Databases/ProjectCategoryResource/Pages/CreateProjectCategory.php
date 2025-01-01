<?php

namespace App\Filament\Resources\Databases\ProjectCategoryResource\Pages;

use App\Filament\Resources\Databases\ProjectCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectCategory extends CreateRecord
{
    protected static string $resource = ProjectCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

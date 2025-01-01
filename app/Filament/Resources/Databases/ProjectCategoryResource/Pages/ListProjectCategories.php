<?php

namespace App\Filament\Resources\Databases\ProjectCategoryResource\Pages;

use App\Filament\Resources\Databases\ProjectCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectCategories extends ListRecords
{
    protected static string $resource = ProjectCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

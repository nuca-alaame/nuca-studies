<?php

namespace App\Filament\Resources\ProjectOperationResource\Pages;

use App\Filament\Resources\ProjectOperationResource;
use App\HasParentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectOperations extends ListRecords
{
    use HasParentResource;

    protected static string $resource = ProjectOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(
                    fn (): string => static::getParentResource()::getUrl('project-operations.create', [
                        'parent' => $this->parent,
                    ])
                ),
        ];
    }
}

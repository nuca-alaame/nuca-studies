<?php

namespace App\Filament\Resources\ProjectOperationResource\Pages;

use App\Filament\Resources\ProjectOperationResource;
use App\HasParentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectOperation extends CreateRecord
{
    use HasParentResource;

    protected static string $resource = ProjectOperationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? static::getParentResource()::getUrl('project-operations.index', [
            'parent' => $this->parent,
        ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set the parent relationship key to the parent resource's ID.
        $data[$this->getParentRelationshipKey()] = $this->parent->id;

        return $data;
    }
}

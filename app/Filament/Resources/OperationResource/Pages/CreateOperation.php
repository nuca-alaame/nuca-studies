<?php

namespace App\Filament\Resources\OperationResource\Pages;

use App\Filament\Resources\OperationResource;
use App\HasParentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOperation extends CreateRecord
{
    use HasParentResource;

    protected static string $resource = OperationResource::class;

    //    protected function getRedirectUrl(): string
    //    {
    //        return static::getParentResource()::getUrl('operations.index', [
    //            'parent' => $this->parent,
    //        ]);
    //    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set the parent relationship key to the parent resource's ID.
        $data[$this->getParentRelationshipKey()] = $this->parent->id;

        return $data;
    }
}

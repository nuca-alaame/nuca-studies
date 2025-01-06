<?php

namespace App\Filament\Resources\ProjectOperationResource\Pages;

use App\Filament\Resources\ProjectOperationResource;
use App\HasParentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectOperation extends EditRecord
{
    use HasParentResource;

    protected static string $resource = ProjectOperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? static::getParentResource()::getUrl('project-operations.index', [
            'parent' => $this->parent,
        ]);
    }

    protected function configureDeleteAction(Actions\DeleteAction $action): void
    {
        $resource = static::getResource();

        $action->authorize($resource::canDelete($this->getRecord()))
            ->successRedirectUrl(static::getParentResource()::getUrl('project-operations.index', [
                'parent' => $this->parent,
            ]));
    }
}

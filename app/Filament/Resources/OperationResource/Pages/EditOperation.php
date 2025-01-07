<?php

namespace App\Filament\Resources\OperationResource\Pages;

use App\Filament\Resources\OperationResource;
use App\HasParentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOperation extends EditRecord
{
    use HasParentResource;

    protected static string $resource = OperationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getParentResource()::getUrl('operations.index', [
            'parent' => $this->parent,
        ]);
    }

    protected function configureDeleteAction(Actions\DeleteAction $action): void
    {
        $resource = static::getResource();

        $action->authorize($resource::canDelete($this->getRecord()))
            ->successRedirectUrl(static::getParentResource()::getUrl('operations.index', [
                'parent' => $this->parent,
            ]));
    }
}

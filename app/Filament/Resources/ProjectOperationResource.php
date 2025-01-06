<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectOperationResource\Pages;
use App\Filament\Resources\ProjectOperationResource\RelationManagers;
use App\HasParentResource;
use App\Models\ProjectOperation;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProjectOperationResource extends Resource
{
    protected static ?string $model = ProjectOperation::class;

    public static ?string $parentResource = ProjectResource::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $label = 'الدراسة';

    protected static ?string $modelLabel = 'دراسة';

    protected static ?string $pluralLabel = 'دراسات الأعمال';

    protected static ?string $navigationLabel = 'قائمة دراسات الأعمال';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make()
//                    ->url(
//                        fn (Pages\ListProjectOperations $livewire, Model $record): string => static::$parentResource::getUrl('project-operations.edit', [
//                            'record' => $record,
//                            'parent' => $livewire->parent,
//                        ])
//                    ),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getRecordTitle(?Model $record): string|null
    {
        return $record->title;
    }
}

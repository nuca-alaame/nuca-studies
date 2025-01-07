<?php

namespace App\Filament\Resources\Databases;

use App\Filament\Resources\Databases\OperationTypeResource\Pages;
use App\Models\OperationType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OperationTypeResource extends Resource
{
    protected static ?string $model = OperationType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'قواعد البيانات';

    protected static ?string $label = 'سند الدراسة';

    protected static ?string $modelLabel = 'سند الدراسة';

    protected static ?string $pluralLabel = 'سند الدراسة';

    protected static ?string $navigationLabel = 'قائمة سند الدراسة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->label('اسم السند'),
                    ])]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('اسم السند')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOperationTypes::route('/'),
            'create' => Pages\CreateOperationType::route('/create'),
            'edit' => Pages\EditOperationType::route('/{record}/edit'),
        ];
    }
}

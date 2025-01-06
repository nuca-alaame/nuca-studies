<?php

namespace App\Filament\Resources\Databases;

use App\Filament\Resources\Databases\SectorResource\Pages;
use App\Filament\Resources\Databases\SectorResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectorResource extends Resource
{
    protected static ?string $model = \App\Models\Sector::class;

    protected static ?string $navigationGroup = 'قواعد البيانات';

    protected static ?string $label = 'القطاع';

    protected static ?string $modelLabel = 'قطاع';

    protected static ?string $pluralLabel = 'القطاعات';

    protected static ?string $navigationLabel = 'قائمة القطاعات';

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->label('اسم القطاع')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('اسم القطاع')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSectors::route('/'),
            'create' => Pages\CreateSector::route('/create'),
            'edit' => Pages\EditSector::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 0;
    }
}
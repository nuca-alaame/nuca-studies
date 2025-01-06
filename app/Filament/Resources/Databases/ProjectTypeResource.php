<?php

namespace App\Filament\Resources\Databases;

use App\Filament\Resources\Databases\ProjectTypeResource\Pages;
use App\Filament\Resources\Databases\ProjectTypeResource\RelationManagers;
use App\Models\ProjectType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectTypeResource extends Resource
{
    protected static ?string $model = ProjectType::class;

    protected static ?string $navigationIcon = 'heroicon-c-server';

    protected static ?string $navigationGroup = 'قواعد البيانات';

    protected static ?string $label = 'نوع أعمال';

    protected static ?string $modelLabel = 'نوع أعمال';

    protected static ?string $pluralLabel = 'أنواع الأعمال';

    protected static ?string $navigationLabel = 'قائمة أنواع الأعمال';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('category_id')->relationship('category', 'name')->label('التصنيف')->required(),
                        Forms\Components\TextInput::make('name')->required()->label('اسم نوع الأعمال')->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('نوع الأعمال')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('التصنيف')->badge()

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')->relationship('category', 'name')->label('التصنيف'),
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
            'index' => Pages\ListProjectTypes::route('/'),
            'create' => Pages\CreateProjectType::route('/create'),
            'edit' => Pages\EditProjectType::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }
}
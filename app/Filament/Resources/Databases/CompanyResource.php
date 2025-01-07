<?php

namespace App\Filament\Resources\Databases;

use App\Filament\Resources\Databases\CompanyResource\Pages;
use App\Filament\Resources\Databases\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-library';

    protected static ?string $navigationGroup = 'قواعد البيانات';

    protected static ?string $label = 'الشركة';

    protected static ?string $modelLabel = 'شركة';

    protected static ?string $pluralLabel = 'الشركات';

    protected static ?string $navigationLabel = 'قائمة الشركات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->label('اسم الشركة'),
                        Forms\Components\TextInput::make('tax_number')->label('الرقم الضريبي'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('اسم الشركة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tax_number')->label('الرقم الضريبي')->default('-')->searchable()->sortable(),

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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }
}

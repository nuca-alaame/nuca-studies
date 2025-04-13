<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages\CreateOperation;
use App\Filament\Resources\OperationResource\Pages\EditOperation;
use App\Filament\Resources\OperationResource\Pages\ListOperations;
use App\Filament\Resources\OperationResource\Pages\ViewOperation;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers\OperationsRelationManager;
use App\Models\City;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-m-cube';

    protected static ?int $navigationSort = 1;

    protected static ?string $label = 'المشروع';

    protected static ?string $modelLabel = 'مشروع';

    protected static ?string $pluralLabel = 'المشروعات';

    protected static ?string $navigationLabel = 'قائمة المشروعات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->label('اسم المشروع'),
                        Forms\Components\Select::make('category_id')->relationship('category', 'name')->required()->label('نوع المشروع'),
                        Forms\Components\Select::make('sector_id')
                            ->live()
                            ->relationship('sector', 'name')
                            ->required()->label('القطاع')
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('city_id', null);
                            }),
                        Forms\Components\Select::make('city_id')
                            ->options(function (callable $get) {
                                $sectorId = $get('sector_id');
                                if ($sectorId) {
                                    return City::query()->where('sector_id', $sectorId)
                                        ->pluck('name', 'id')
                                        ->toArray();
                                }

                                return [];
                            })
                            ->required()->label('اسم المدينة'),
                        Forms\Components\Select::make('company_id')->relationship('company', 'name')->required()->label('الشركة المنفذة'),
                        Forms\Components\TextInput::make('assignment_no')->required()->label('رقم أمر الإسناد'),
                        Forms\Components\DatePicker::make('assignment_date')->required()->label('تاريخ أمر الإسناد'),
                        Forms\Components\TextInput::make('assignment_value')->required()->label('قيمة أمر الإسناد')->numeric(),
                        Forms\Components\TextInput::make('supervisory_authority')->label('جهة الإشراف'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('اسم المشروع')->wrap()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('city.name')->label('المدينة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('نوع المشروع')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('company.name')->label('اسم الشركة')->wrap()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('assignment_no')->label('رقم أمر الإسناد')->searchable()->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('sector_id')->relationship('sector', 'name')->label('القطاع'),
                Tables\Filters\SelectFilter::make('city_id')->relationship('city', 'name')->label('المدينة'),
                Tables\Filters\SelectFilter::make('category_id')->relationship('category', 'name')->label('نوع المشروع'),
                Tables\Filters\SelectFilter::make('company_id')->relationship('company', 'name')->label('الشركة'),
            ])
            ->actions([

                Tables\Actions\Action::make('الدراسات')
                    ->color('success')
                    ->icon('heroicon-m-academic-cap')
                    ->url(
                        fn (Project $record): string => static::getUrl('operations.index', [
                            'parent' => $record->id,
                        ])
                    ),
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
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
            OperationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'view' => Pages\ViewProject::route('/{record}'),
            'operations.index' => ListOperations::route('/{parent}/operations'),
            'operations.create' => CreateOperation::route('/{parent}/operations/create'),
            'operations.edit' => EditOperation::route('/{parent}/operations/{record}/edit'),
            'operations.view' => ViewOperation::route('/{parent}/operations/{record}'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 0;
    }

    public static function getRecordTitle($record): ?string
    {
        return $record->name;
    }
}

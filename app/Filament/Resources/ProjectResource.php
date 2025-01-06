<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectOperationResource\Pages\CreateProjectOperation;
use App\Filament\Resources\ProjectOperationResource\Pages\EditProjectOperation;
use App\Filament\Resources\ProjectOperationResource\Pages\ListProjectOperations;
use App\Filament\Resources\ProjectOperationResource\RelationManagers\OperationsRelationManager;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\ProjectOperation;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-m-cube';

    protected static ?string $navigationGroup = 'المشروعات';

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
                                // Dynamically fetch cities based on selected sector_id
                                $sectorId = $get('sector_id');
                                if ($sectorId) {
                                    return \App\Models\City::where('sector_id', $sectorId)
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
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('اسم المشروع')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('city.name')->label('المدينة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('نوع المشروع')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('company.name')->label('اسم الشركة')->searchable()->sortable(),
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
                        fn(Project $record): string => static::getUrl('project-operations.index', [
                            'parent' => $record->id,
                        ])
                    ),
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
            // OperationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
            'project-operations.index' => ListProjectOperations::route('/{parent}/operations'),
            'project-operations.create' => CreateProjectOperation::route('/{parent}/operations/create'),
            'project-operations.edit' => EditProjectOperation::route('/{parent}/operations/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 0;
    }

    public static function getRecordTitle(Model|\Illuminate\Database\Eloquent\Model|null $record): string|null
    {
        return $record->name;
    }
}

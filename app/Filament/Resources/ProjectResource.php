<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
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

    protected static ?string $pluralLabel = 'المشروع';

    protected static ?string $navigationLabel = 'قائمة المشروعات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->label('اسم المشروع'),
                        Forms\Components\Select::make('category_id')->relationship('category', 'name')->required()->label('نوع المشروع'),
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
                //
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 0;
    }
}

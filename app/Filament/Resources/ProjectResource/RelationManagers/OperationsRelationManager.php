<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OperationsRelationManager extends RelationManager
{
    protected static string $relationship = 'operations';

    protected static ?string $title = 'دراسات الأعمال الخاصة بالمشروع';

    protected static ?string $label = 'الدراسة';

    protected static ?string $modelLabel = 'دراسة';

    protected static ?string $pluralLabel = 'الدراسات';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type_id')->label('سند الدراسة')->relationship('type', 'name'),
                DatePicker::make('operation_date')->label('تاريخ دخول الدراسة للجنة')->required(),
                TextInput::make('inbox_no')->label('وارد الوحدة الرئيسية')->required(),
                DatePicker::make('approval_date')->label('تاريخ الدراسة (اعتماد الوحدة الرئيسية)')->required(),
                TextInput::make('timeframe')->label('النطاق الزمني لتنفيذ الاعمال'),
                Select::make('balancing_method')->label('أسلوب إعادة التوازن المالي للعقد')
                    ->options([
                        'دراسة على فترات' => 'دراسة على فترات',
                        'دراسة فروق أسعار' => 'دراسة فروق أسعار',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#')->alignCenter(),
                Tables\Columns\TextColumn::make('operation_date')->label('تاريخ دخول الدراسة للجنة')->searchable()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('type.name')->label('سند الدراسة')->searchable()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('inbox_no')->label('وارد الوحدة الرئيسية')->searchable()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('approval_date')->label('تاريخ الدراسة')->searchable()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('timeframe')->label('النطاق الزمني لتنفيذ الاعمال')->searchable()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('balancing_method')->label('أسلوب إعادة التوازن المالي للعقد')->badge()->searchable()->sortable()->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                //                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->paginated(false);
    }
}

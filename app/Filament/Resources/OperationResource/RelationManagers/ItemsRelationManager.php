<?php

namespace App\Filament\Resources\OperationResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $label = 'البند';

    protected static ?string $modelLabel = 'بند';

    protected static ?string $pluralLabel = 'بنود الدراسة';

    protected static ?string $title = 'بنود الدراسة';

    public function form(Form $form): Form
    {
        return $form
            ->columns(4)
            ->schema([
                TextInput::make('name')->label('اسم البند')->required()->columnSpan(2),
                TextInput::make('unit')->label('الوحدة')->required(),
                TextInput::make('quantity')->label('الكمية')->required(),
                TextInput::make('price_before')->label('الفئة (قبل المراجعة) ')->numeric()->required(),
                TextInput::make('price_after')->label('الفئة (بعد المراجعة) ')->numeric(),
                DatePicker::make('start_date')->label('فترة التنفيذ من')->required(),
                DatePicker::make('end_date')->label('فترة التنفيذ إلى')->required(),
                Textarea::make('notes')->label('ملاحظات')->columnSpan(4),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('البند')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('unit')->label('الوحدة')->searchable()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('quantity')->label('الكمية')->alignCenter(),
                Tables\Columns\TextColumn::make('price_before')->label('الفئة (قبل المراجعة)')->alignCenter(),
                Tables\Columns\TextColumn::make('total_before')->label('الإجمالي (قبل المراجعة)')->badge()->color('info')->alignCenter(),
                Tables\Columns\TextColumn::make('price_after')->label('الفئة (بعد المراجعة)')->alignCenter(),
                Tables\Columns\TextColumn::make('total_after')->label('الإجمالي (بعد المراجعة)')->badge()->color('success')->alignCenter(),
                Tables\Columns\TextColumn::make('start_date')->label('فترة التنفيذ من')->badge()->alignCenter(),
                Tables\Columns\TextColumn::make('end_date')->label('فترة التنفيذ إلى')->badge()->alignCenter(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->paginated(false);
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages;
use App\Filament\Resources\OperationResource\RelationManagers\ItemsRelationManager;
use App\Models\Operation;
use App\Models\Project;
use App\Models\ProjectType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OperationResource extends Resource
{
    protected static ?string $model = Operation::class;

    public static ?string $parentResource = ProjectResource::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $label = 'الدراسة';

    protected static ?string $modelLabel = 'دراسة';

    protected static ?string $pluralLabel = 'دراسات الأعمال';

    protected static ?string $navigationLabel = 'قائمة دراسات الأعمال';

    public static function form(Form $form): Form
    {
        $catId = Project::query()->where('id', intval(request()->route('parent')))->first()?->category_id;

        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('type_id')
                            ->label('سند الدراسة')
                            ->relationship('type', 'name'),
                        DatePicker::make('operation_date')->label('تاريخ دخول الدراسة للجنة')->required(),
                        TextInput::make('inbox_no')->label('وارد الوحدة الرئيسية')->required(),
                        DatePicker::make('approval_date')->label('تاريخ الدراسة (اعتماد الوحدة الرئيسية)')->required(),
                        TextInput::make('timeframe')->label('النطاق الزمني لتنفيذ الاعمال'),
                        Select::make('balancing_method')
                            ->label('أسلوب إعادة التوازن المالي للعقد')
                            ->options([
                                'دراسة على فترات' => 'دراسة على فترات',
                                'دراسة فروق أسعار' => 'دراسة فروق أسعار',
                            ]),

                        //                        Select::make('projectTypes')
                        //                            ->required()
                        //                            ->multiple()
                        //                            ->preload()
                        //                            ->options(ProjectType::query()->where('category_id', $catId)->pluck('name', 'id')->toArray())
                        //                            ->label('نوع الأعمال المدروسة'),
                    ]),
                //                Section::make()
                //                    ->schema([
                //                        Repeater::make('items')
                //                            ->columns(8)
                //                            ->label('بنود الدراسة')
                //                            ->relationship('items')
                //                            ->addActionLabel('بند جديد')
                //                            ->schema([
                //                                TextInput::make('name')->label('البند')->required(),
                //                                TextInput::make('unit')->label('الوحدة')->required(),
                //                                TextInput::make('quantity')->label('الكمية')->required(),
                //                                TextInput::make('price_before')->label('الفئة (قبل المراجعة) ')->numeric()->required(),
                //                                TextInput::make('price_after')->label('الفئة (بعد المراجعة) ')->numeric(),
                //                                DatePicker::make('start_date')->label('فترة التنفيذ من')->required(),
                //                                DatePicker::make('end_date')->label('فترة التنفيذ إلى')->required(),
                //                                TextInput::make('notes')->label('ملاحظات'),
                //                            ]),
                //                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('')
                    ->url(
                        fn (Pages\ListOperations $livewire, Model $record): string => static::$parentResource::getUrl('operations.view', [
                            'record' => $record,
                            'parent' => $livewire->parent,
                        ])
                    ),
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->url(
                        fn (Pages\ListOperations $livewire, Model $record): string => static::$parentResource::getUrl('operations.edit', [
                            'record' => $record,
                            'parent' => $livewire->parent,
                        ])
                    ),
                Tables\Actions\DeleteAction::make()
                    ->label(''),
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
            ItemsRelationManager::class,
        ];
    }

    public static function getRecordTitle(?Model $record): ?string
    {
        return 'دراسة بتاريخ '.$record->operation_date;
    }
}

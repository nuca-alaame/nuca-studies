<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'إدارة الوصول';

    protected static ?string $label = 'المستخدم';

    protected static ?string $modelLabel = 'المستخدم';

    protected static ?string $pluralLabel = 'المستخدمين';

    protected static ?string $navigationLabel = 'قائمة المستخدمين';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('الاسم'),
                Forms\Components\TextInput::make('email')->required()->label('البريد الالكتروني'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->same('password_confirmation')
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->minLength('6')
                    ->maxLength('20')
                    ->label('كلمة المرور'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->dehydrated(false)
                    ->required(fn (string $context): bool => $context === 'create')
                    ->label('إعادة كلمة المرور'),
                Forms\Components\CheckboxList::make('roles')->label('الصلاحية')->relationship('roles', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الاسم'),
                Tables\Columns\TextColumn::make('email')->label('البريد الالكتروني'),
                Tables\Columns\TextColumn::make('roles.name')->label('الصلاحية')->badge()->alignCenter(),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

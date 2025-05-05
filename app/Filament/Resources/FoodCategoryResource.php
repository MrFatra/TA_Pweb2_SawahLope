<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FoodCategoryResource\Pages;
use App\Filament\Resources\FoodCategoryResource\RelationManagers;
use App\Models\FoodCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FoodCategoryResource extends Resource
{
    protected static ?string $model = FoodCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getModelLabel(): string
    {
        return 'Kategori Menu';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    })
                    ->maxLength(255)
                    ->unique(FoodCategory::class, 'name', ignoreRecord: true),
                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->helperText('Slug akan terisi otomatis jika Anda telah selesai mengedit form "Nama".')
                    ->required()
                    ->maxLength(255)
                    ->unique(FoodCategory::class, 'slug', ignoreRecord: true),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Kategori')
                    ->maxLength(65535)
                    ->rows(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(30)
                    ->tooltip(fn($record) => $record->description)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->color('info'),
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
            'index' => Pages\ListFoodCategories::route('/'),
            'create' => Pages\CreateFoodCategory::route('/create'),
            'view' => Pages\ViewFoodCategory::route('/{record}'),
            'edit' => Pages\EditFoodCategory::route('/{record}/edit'),
        ];
    }
}
